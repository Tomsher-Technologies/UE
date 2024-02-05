<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Common\DynamicContents;
use App\Models\Common\Settings;
use App\Models\Integrators\Integrator;
use App\Models\Orders\Order;
use App\Models\Orders\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function bookingView(Request $request)
    {
        $details = Auth()->user()->customerDetails;

        $terms = Cache::rememberForever('terms', function () {
            return DynamicContents::where('name', 'terms')->first();
        });

        return view('reseller.pages.booking')->with([
            'orequest' => $request,
            'details' => $details,
            'terms' => $terms,
        ]);
    }

    public function booking(Request $request)
    {
        $this->authenticate();

        $integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });

        $integrator = $integrators->where('id', $request->integrator)->first();

        $search = Search::with(['items', 'toCountry', 'fromCountry'])->find($request->search_id);


        $total_pices = 0;
        $total_height = 0;
        $total_width = 0;
        $total_length = 0;

        foreach($search->items as $item){
            $total_pices += $item->no_pieces;
            $total_height += $item->height;
            $total_width += $item->width;
            $total_length += $item->length;
        }

        $order = Order::create([
            'user_id' => Auth()->user()->id,
            'integrator_id' => $request->integrator,
            'search_id' => $request->search_id,
            'shipper_name' => $request->shipper_name,
            'shipper_phone' => $request->shipper_phone,
            'shipper_address' => $request->shipper_address,
            'consignee_name' => $request->receiver_name,
            'consignee_email' => $request->receiver_email,
            'consignee_phone' => $request->receiver_phone,
            'consignee_address' => $request->receiver_address,
            'consignee_town' => $request->receiver_town,
            'consignee_province' => $search->toCountry->code,
            'item_name' => $request->item_name,
            'rate' => $request->rate,
            'billable_weight' => $request->totalweight,
            'hawbNumber' => "",
            'invoice_url' => "",
            'order_status' => 0,
        ]);

        $requestArray = array();

        $requestArray["CustomerHawb"] = "";
        $requestArray["SenderName"] = $request->shipper_name;
        $requestArray["SenderAddress"] = $request->shipper_address;
        $requestArray["SenderPhone"] = str_replace(' ', '', $request->shipper_phone);
        $requestArray["HawbNumber"] = "";

        $requestArray["ReceiverName"] = $request->receiver_name;
        $requestArray["ReceiverAddress1"] = $request->receiver_address;
        $requestArray["ReceiverTown"] = $request->receiver_town;
        $requestArray["ReceiverTel"] = str_replace(' ', '', $request->receiver_phone);
        $requestArray["ReceiverEmail"] = $request->receiver_email;
        $requestArray["ReceiverCountry"] = $search->toCountry->code;

        // dd($search->to_city !== NULL ? $search->to_city : $request->receiver_town);

        $requestArray["ReceiverProvince"] = NULL;
        if ($search->toCountry->code == 'US') {
            $res = Http::send('POST', "http://postalcode.parseapi.com/api/885ca868ff01a9f6ddc424d2d0a84cac/$search->to_pin", ['verify' => false]);
            if ($res->status() == '200') {
                $json = json_decode($res->body());
                if (isset($json->state)) {
                    $requestArray["ReceiverProvince"] = $json->state->alpha2;
                }
            }
        }

        $requestArray["ReceiverCity"] = $search->to_city !== NULL ? $search->to_city : $request->receiver_town;
        $requestArray["ReceiverZip"] = $search->to_pin == NULL ? 0 : $search->to_pin;
        $requestArray["ReceiverContactPerson"] = $request->receiver_contact_person;

        $requestArray["Weight"] = (float)$request->totalweight;
        $requestArray["DeclareCurrency"] = $request->currency;
        $requestArray["DeclareValue"] = $request->declare_value;
        $requestArray["ServiceCode"] = $integrator->service_code;
        $requestArray["DutyType"] = "DDU";
        $requestArray["Content"] = $request->item_name;

        $requestArray["ReceiverId"] = "";
        $requestArray["ImportBatchId"] = "";
        $requestArray["ShipmentType"] = 20;
        $requestArray["PaymentType"] = "";
        $requestArray["Pieces"] = $total_pices;
        $requestArray["Height"] = $total_height;
        $requestArray["Width"] = $total_width;
        $requestArray["Length"] = $total_length;
        $requestArray["InsuranceValue"] = 0;
        $requestArray["Remark"] = "";
        $requestArray["GenerateShippingLabel"] = true;

        $requestArray["HawbItems"] = array();

        $requestArray["HawbItems"][] = array(
            'Content' => $request->item_name,
            'Price' => 1.0,
            'Pieces' => $search->number_of_pieces,
            "Weight" => (float)$request->totalweight,
            "HsCode" => "00",
            "WebSite" => ""
        );

        foreach ($search->items as $item) {
            $requestArray["hawbChildren"][] = array(
                "ChildCustomerHawb" => $request->item_name,
                "Weight" => (float)$item->weight,
                "Height" => (float)$item->height,
                "Width" => (float)$item->width,
                "Length" => (float)$item->length
            );
        }

        if($integrator->internal_code == 'dhl'){
            $requestArray["valueAddedServices"][] = array(
                "serviceCode"=> "WY"
            );
        }

        $logger =  Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/se/hub_req.json'),
        ]);
        $logger->info(json_encode($requestArray));

        // dd(json_encode($requestArray));

        $response = Http::withToken(Session::get('hubezToken'))->post(config('app.hubez_url') . 'services/app/hawb/apiCreateHawb', $requestArray);

        $responseCollection = $response->json('result');

        if($integrator->internal_code == 'dhl' && $responseCollection['result'] == false && Str::contains($responseCollection['resultMsg'],'WDDHLNPLT')  ){

            $requestArray['ServiceCode'] = 'WDDHLNPLT';
            unset($requestArray["valueAddedServices"]);

            $logger =  Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/se/hub_req.json'),
            ]);
            $logger->info(json_encode($requestArray));

            $response = Http::withToken(Session::get('hubezToken'))->post(config('app.hubez_url') . 'services/app/hawb/apiCreateHawb', $requestArray);
            $responseCollection = $response->json('result');

            // dd($responseCollection);
        }

        $logger =  Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/se/hub_res.json'),
        ]);
        $logger->info(json_encode($responseCollection));

        if ($response->status() == 200 && $responseCollection['result']) {

            $response2 = Http::withToken(Session::get('hubezToken'))->post(config('app.hubez_url') . 'services/app/hawb/GetHawbLables', array($responseCollection['hawbNumber']));

            $order->update([
                'hawbNumber' => $responseCollection['hawbNumber'],
                'invoice_url' => $responseCollection['resultMsg'],
                'order_status' => 1,
            ]);

            $customer_details = Auth()->user()->customerDetails;
            $customer_details->update([
                'credit_limit' => $customer_details->credit_limit - $request->rate
            ]);

            // current_credit

            // $mailer = new MailController();
            // $mailer->newBooking(Auth()->user(), $order);
        } else {
            $order->update([
                'invoice_url' => $responseCollection['resultMsg'],
                'order_status' => 2,
            ]);
        }
        $order->save();

        // dd(json_encode($responseCollection));

        return redirect()->route('reseller.booking.history.details', $order);

        // return view('reseller.pages.order.success')->with([
        //     'order' => $order,
        //     'integrator' => $integrator,
        //     'search' => $search,
        // ]);
    }

    public function authenticate()
    {
        if (!Session::has('hubezToken')) {
            $params = Cache::rememberForever('hubezKeys', function () {
                return Settings::whereGroup('hubez')->get()->keyBy('name');
            });

            $response = Http::post(config('app.hubez_url') . 'account/Authenticate', [
                'UsernameOrEmailAddress' => $params['username']->value,
                'Password' => $params['password']->value,
            ]);

            if ($response->status() == 200) {
                $token = $response->json()['result'];
                if ($token) {
                    Session::put('hubezToken', $token);
                }
            } else {
                abort(404);
            }
        }
    }

    public function bookingHistory()
    {
        // $booking_history = Auth()->user()->orders()->where('order_status', '!=', 0)->with(['integrator', 'search'])->paginate(15);
        // // ddd($booking_history);
        // return view('reseller.pages.booking_history')->with([
        //     'bookings' => $booking_history,
        // ]);
        return view('reseller.pages.new_booking_history');
    }

    public function bookingHistoryDetails(Order $order)
    {
        $integrator = $order->integrator;
        $search = $order->search;
        return view('reseller.pages.order.success')->with([
            'order' => $order,
            'integrator' => $integrator,
            'search' => $search,
        ]);
    }

    public function agentsBookingHistory()
    {
        $users = Auth()->user()->children()->select('id')->get()->toArray();
        $booking_history = Order::whereIn('user_id', $users)->where('order_status', '!=', 0)->with(['integrator', 'search', 'user'])->paginate(15);
        return view('reseller.agents.booking_history')->with([
            'bookings' => $booking_history,
        ]);
        // return view('reseller.agents.new_booking_history');
    }
}

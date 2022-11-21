<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Common\MailController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reseller\BookingRequest;
use App\Models\Common\DynamicContents;
use App\Models\Common\Settings;
use App\Models\Integrators\Integrator;
use App\Models\Orders\Order;
use App\Models\Orders\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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
        $requestArray["ReceiverProvince"] = $search->toCountry->code;
        $requestArray["ReceiverCity"] = $search->to_city;
        $requestArray["ReceiverZip"] = $search->to_pin ?? 0;
        $requestArray["ReceiverContactPerson"] = $request->receiver_contact_person;

        $requestArray["Weight"] = $request->totalweight;
        $requestArray["DeclareCurrency"] = "AED";
        $requestArray["DeclareValue"] = 1.0;
        $requestArray["ServiceCode"] = $integrator->service_code;
        $requestArray["DutyType"] = "DDU";
        $requestArray["Content"] = $request->item_name;

        $requestArray["ReceiverId"] = "";
        $requestArray["ImportBatchId"] = "";
        $requestArray["ShipmentType"] = 20;
        $requestArray["PaymentType"] = "";
        $requestArray["Pieces"] = "1";
        $requestArray["Height"] = "";
        $requestArray["Width"] = "";
        $requestArray["Length"] = "";
        $requestArray["InsuranceValue"] = 0;
        $requestArray["Remark"] = "";
        $requestArray["GenerateShippingLabel"] = true;

        $requestArray["HawbItems"] = array();

        $requestArray["HawbItems"][] = array(
            'Content' => $request->item_name,
            'Price' => 1.0,
            'Pieces' => $search->number_of_pieces,
            "Weight" => $request->totalweight,
            "HsCode" => "",
            "WebSite" => ""
        );

        foreach ($search->items as $item) {
            $requestArray["hawbChildren"][] = array(
                "ChildCustomerHawb" => $request->item_name,
                "Weight" => $item->weight,
                "Height" => $item->height,
                "Width" => $item->width,
                "Length" => $item->length
            );
        }

        $response = Http::withToken(Session::get('hubezToken'))->post(config('app.hubez_url') . 'services/app/hawb/apiCreateHawb', $requestArray);

        $responseCollection = $response->json('result');

        if ($response->status() == 200 && $responseCollection['result']) {
            $order->update([
                'hawbNumber' => $responseCollection['hawbNumber'],
                'invoice_url' => $responseCollection['resultMsg'],
                'order_status' => 1,
            ]);
            $order->save();

            $mailer = new MailController();
            $mailer->newBooking(Auth()->user(), $order);
        } else {
            $order->update([
                'invoice_url' => $responseCollection['resultMsg'],
                'order_status' => 2,
            ]);
            $order->save();
        }

        return view('reseller.pages.order.success')->with([
            'order' => $order,
            'integrator' => $integrator,
            'search' => $search,
        ]);
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
        $booking_history = Auth()->user()->orders()->where('order_status', '!=', 0)->with(['integrator', 'search'])->paginate(15);
        // ddd($booking_history);
        return view('reseller.pages.booking_history')->with([
            'bookings' => $booking_history,
        ]);
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
}

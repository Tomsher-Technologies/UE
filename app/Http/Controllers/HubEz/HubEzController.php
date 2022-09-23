<?php

namespace App\Http\Controllers\HubEz;

use App\Http\Controllers\Controller;
use App\Models\Common\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HubEzController extends Controller
{
    public function authenticate()
    {
        if (!Session::has('hubezToken')) {

            $params = Cache::rememberForever('hubezKeys', function () {
                return Settings::whereGroup('hubez')->get();
            });

            $response = Http::post('http://www.hub-ez.com/api/account/Authenticate', [
                'UsernameOrEmailAddress' => 'WEBTEST',
                'Password' => 'WEBTEST@43',
            ]);

            $token = $response->json()['result'];

            if ($token) {
                Session::put('hubezToken', $token);
            }
        }
    }

    public function placeOrder()
    {
        $this->authenticate();

        $jayParsedAry = [
            // "CustomerHawb" => "MAY498563",
            "SenderName" => null,
            "SenderAddress" => null,
            "SenderPhone" => null,
            "HawbNumber" => null,
            "ReceiverName" => "Draco Wu",
            "ReceiverAddress1" => "G/F 527 SHA KONG WAI",
            "ReceiverTown" => "堺市",
            "ReceiverTel" => 12345875956,
            "ReceiverContactPerson" => null,
            "ReceiverCountry" => "JP",
            "ReceiverProvince" => "大阪府",
            "ReceiverCity" => "堺市",
            "ReceiverZip" => 5918799,
            "Weight" => 0.26,
            "DeclareCurrency" => "GBP",
            "DeclareValue" => 35.66,
            "ServiceCode" => "WDUPS",
            "DutyType" => "DDU",
            "Content" => "Disney Classic Core Dumbo 35cm*1",
            "ReceiverEmail" => "ee2222hk@gmail.com",
            "ReceiverId" => null,
            "ImportBatchId" => null,
            "ShipmentType" => 20,
            "PaymentType" => null,
            "Pieces" => null,
            "Height" => null,
            "Width" => null,
            "Length" => null,
            "InsuranceValue" => 0,
            "Eemark" => null,
            "HawbItems" => [
                [
                    "Content" => "Disney Classic Core Dumbo 35cm",
                    "Price" => 35.66,
                    "Pieces" => 1,
                    "Weight" => 0.26,
                    "HsCode" => null,
                    "WebSite" => ""
                ]
            ],
            "hawbChildren" => [
                [
                    "ChildCustomerHawb" => "mother Reference number",
                    "Weight" => 0.3,
                    "Height" => 20,
                    "Width" => 20,
                    "Length" => 20
                ],
                [
                    "ChildCustomerHawb" => "child Reference number",
                    "Weight" => 0.3,
                    "Height" => 20,
                    "Width" => 20,
                    "Length" => 20
                ]
            ]
        ];

        $response = Http::withToken(Session::get('hubezToken'))->post('http://www.hub-ez.com/api/services/app/hawb/apiCreateHawb', $jayParsedAry);
        dd($response->json());
    }
}

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
                return Settings::whereGroup('hubez')->get()->keyBy('name');
            });

            $response = Http::post('http://www.hub-ez.com/api/account/Authenticate', [
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

    public function placeOrder()
    {
        $this->authenticate();

        $requestArray = [
            "CustomerHawb" => "",
            "SenderName" => "Shabeersha",
            "SenderAddress" => "Wafi Recidence",
            "SenderPhone" => "123456789",
            "HawbNumber" => "",
            "ReceiverName" => "Tomsher",
            "ReceiverAddress1" => "Wafi Recidence",
            "ReceiverTown" => "Alappuzha",
            "ReceiverTel" => "12345875956",
            "ReceiverContactPerson" => "Test",
            "ReceiverCountry" => "IN",
            "ReceiverProvince" => "IN",
            "ReceiverCity" => "ALLEPPEY",
            "ReceiverZip" => 690102,
            "Weight" => 0.26,
            "DeclareCurrency" => "INR",
            "DeclareValue" => 35.66,
            "ServiceCode" => "WDUPS",
            "DutyType" => "DDU",
            "Content" => "Disney Classic Core Dumbo 35cm*1",
            "ReceiverEmail" => "ee2222hk@gmail.com",
            "ReceiverId" => "",
            "ImportBatchId" => "",
            "ShipmentType" => 20,
            "PaymentType" => "",
            "Pieces" => "1",
            "Height" => "",
            "Width" => "",
            "Length" => "",
            "InsuranceValue" => 0,
            "Eemark" => "",
            "HawbItems" => [
                [
                    "Content" => "Disney Classic Core Dumbo 35cm",
                    "Price" => 35.66,
                    "Pieces" => 1,
                    "Weight" => 0.26,
                    "HsCode" => "",
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

        $response = Http::withToken(Session::get('hubezToken'))->post('http://www.hub-ez.com/api/services/app/hawb/apiCreateHawb', $requestArray);
        dd($response->json());
    }
}

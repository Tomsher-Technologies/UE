<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Orders\Search;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ODAController extends Controller
{
    public function checkODA($integrator_code, Search $search)
    {
        $charge = 0;

        $search->load([
            'toCountry',
            'fromCountry',
        ]);

        // dd($charge);

        // $from_country_code = $search

        switch ($integrator_code) {
            case 'dhl':
                $charge = $this->dhl();
                break;

            case 'fedex':
                $charge = $this->dhl();
                break;

            case 'ups':
                $charge = $this->dhl();
                break;

            default:
                $charge = $this->dhl();
                break;
        }

        return $charge;
    }

    public function dhl()
    {


        $client = new Client();

        $response = $client->request('POST', 'http://localhost/');

        dd($response->getBody());


        dd("Asd");

        $xml = '<?xml version="1.0" encoding="utf-8"?>
        <p:DCTRequest xmlns:p="http://www.dhl.com" xmlns:p1="http://www.dhl.com/datatypes" xmlns:p2="http://www.dhl.com/DCTRequestdatatypes" schemaVersion="2.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com DCT-req.xsd">
          <GetQuote>
            <Request>
              <ServiceHeader>
                <MessageTime>2022-07-26T12:41:22+04:00</MessageTime>
                <MessageReference>12121200000000000001000186352</MessageReference>
                <SiteID>v62_HgPv70HtD2</SiteID>
                <Password>2kIw86yqfs</Password>
              </ServiceHeader>
              <MetaData>
                <SoftwareName>Integra</SoftwareName>
                <SoftwareVersion>1.0</SoftwareVersion>
              </MetaData>
            </Request>
            <From>
              <CountryCode>AE</CountryCode>
              <City>Dubai</City>
            </From>
            <BkgDetails>
              <PaymentCountryCode>AE</PaymentCountryCode>
              <Date>2022-07-26</Date>
              <ReadyTime>PT12H22M</ReadyTime>
              <DimensionUnit>CM</DimensionUnit>
              <WeightUnit>KG</WeightUnit>
              <Pieces>
                <Piece>
                  <PieceID>1</PieceID>
                  <Weight>0.2</Weight>
                </Piece>
              </Pieces>
              <PaymentAccountNumber>471110617</PaymentAccountNumber>
              <QtdShp />
            </BkgDetails>
            <To>
              <CountryCode>LB</CountryCode>
              <City>BEIRUT</City>
            </To>
          </GetQuote>
        </p:DCTRequest>';

        $options = [
            'headers' => [
                'Content-Type' => 'text/xml; charset=UTF8'
            ],
            'body' => $xml
        ];

        $client = new Client();

        $response = $client->request('POST', 'http://www.dhl.com', $options);

        dd($response->getBody());
    }

    public function ups($from_address, $to_address)
    {
        # code...
    }

    public function fedex($from_address, $to_address)
    {
        # code...
    }

    public function db($from_address, $to_address)
    {
    }
}

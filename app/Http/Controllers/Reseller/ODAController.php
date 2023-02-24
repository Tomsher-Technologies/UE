<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Orders\Search;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;
use SoapClient;

class ODAController extends Controller
{
    public function checkODA($integrator_code, Search $search)
    {
        $charge = 0;

        $search->load([
            'toCountry',
            'fromCountry',
            'items',
        ]);

        $weight = 0;
        $length = 0;
        $height = 0;
        $width = 0;

        foreach ($search->items as $item) {
            $weight += $item->weight;
            $length += $item->length;
            $height += $item->height;
            $width += $item->width;
        }

        switch ($integrator_code) {
            case 'dhl':
                $charge = $this->ups($search, $weight, $length, $height, $width);
                break;

            case 'fedex':
                $charge = $this->ups($search, $weight, $length, $height, $width);
                break;

            case 'ups':
                $charge = $this->ups($search, $weight, $length, $height, $width);
                break;

            default:
                $charge = $this->ups($search, $weight, $length, $height, $width);
                break;
        }

        return $charge;
    }

    public function dhl(Search $search, $weight)
    {
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
              <CountryCode>' . $search->fromCountry->code . '</CountryCode>
              <City>' . $search->from_city . '</City>
            </From>
            <BkgDetails>
              <PaymentCountryCode>AE</PaymentCountryCode>
              <Date>' . Carbon::now()->format('Y-m-d') . '</Date>
              <ReadyTime>PT12H22M</ReadyTime>
              <DimensionUnit>CM</DimensionUnit>
              <WeightUnit>KG</WeightUnit>
              <Pieces>
                <Piece>
                  <PieceID>' . $search->number_of_pieces . '</PieceID>
                  <Weight>' . $weight . '</Weight>
                </Piece>
              </Pieces>
              <PaymentAccountNumber>471110617</PaymentAccountNumber>
              <QtdShp />
            </BkgDetails>
            <To>
              <CountryCode>' . $search->toCountry->code . '</CountryCode>
              <City>' . $search->to_city . '</City>
            </To>
          </GetQuote>
        </p:DCTRequest>';

        $res = Http::withBody($xml, 'text/xml')->send('POST', 'https://xmlpi-ea.dhl.com/XMLShippingServlet', ['verify' => false]);

        if ($res->status() == '200') {
            $xmlObject = simplexml_load_string($res->body());

            $json = json_encode($xmlObject);
            $phpArray = json_decode($json, true);

            if ($phpArray['GetQuoteResponse'] && $phpArray['GetQuoteResponse']['BkgDetails']) {
                if ($phpArray['GetQuoteResponse']['Note']['ActionStatus'] == "Success") {
                    if ($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp']['QtdShpExChrg']) {
                        // dd($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp']['QtdShpExChrg']);
                        foreach ($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp']['QtdShpExChrg'] as $item) {
                            if ($item['GlobalServiceName'] == "REMOTE AREA DELIVERY") {
                                return (int)$item['ChargeValue'];
                            }
                        }
                    }
                }
            }
        }

        return 0;
    }

    public function ups(Search $search, $weight, $length, $height, $width)
    {
        $url = "https://onlinetools.ups.com/ups.app/xml/ShipConfirm";

        $xml = '<?xml version="1.0"?>
        <AccessRequest xml:lang="en-US">
            <AccessLicenseNumber>4DB0A329A26C3492</AccessLicenseNumber>
            <UserId>universalexp</UserId>
            <Password>Linexdubai123@</Password>
        </AccessRequest>
        <?xml version="1.0"?>
        <ShipmentConfirmRequest xml:lang="en-US">
            <Request>
                <TransactionReference>
                    <CustomerContext>universalexp</CustomerContext>
                </TransactionReference>
                <RequestAction>ShipConfirm</RequestAction>
                <RequestOption>validate</RequestOption>
            </Request>
            <Shipment>
                <Shipper>
                    <Name>universalexp</Name>
                    <AttentionName></AttentionName>
                    <CompanyDisplayableName>universalexp</CompanyDisplayableName>
                    <PhoneNumber>971-562979199</PhoneNumber>
                    <ShipperNumber>W7583F</ShipperNumber>
                    <TaxIdentificationNumber>1234567877</TaxIdentificationNumber>
                    <Address>
                        <AddressLine1>Dubai</AddressLine1>
                        <City>Dubai</City>
                        <PostalCode>0</PostalCode>
                        <CountryCode>AE</CountryCode>
                    </Address>
                </Shipper>
                <ShipTo>
                    <CompanyName>CompanyName</CompanyName>
                    <AttentionName>Ship To Attn Name</AttentionName>
                    <PhoneNumber>1234567890</PhoneNumber>
                    <Address>
                        <AddressLine1>' . $search->to_city . '</AddressLine1>
                        <City>' . $search->to_city . '</City>
                        <PostalCode>' . $search->to_pin . '</PostalCode>
                        <CountryCode>' . $search->toCountry->code . '</CountryCode>
                    </Address>
                </ShipTo>
                <ShipFrom>
                    <CompanyName>CompanyName</CompanyName>
                    <AttentionName>Ship From Attn Name</AttentionName>
                    <PhoneNumber>1234567890</PhoneNumber>
                    <Address>
                        <AddressLine1>' . $search->from_city . '</AddressLine1>
                        <City>' . $search->from_city . '</City>
                        <PostalCode>' . $search->from_pin . '</PostalCode>
                        <CountryCode>' . $search->fromCountry->code . '</CountryCode>
                    </Address>
                </ShipFrom>
                <PaymentInformation>
                    <Prepaid>
                        <BillShipper>
                            <AccountNumber>W7583F</AccountNumber>
                        </BillShipper>
                    </Prepaid>
                </PaymentInformation>
                <Service>
                    <Code>01</Code>
                    <Description>UPS Express</Description>
                </Service>
                <Package>
                    <PackagingType>
                        <Code>02</Code>
                        <Description>Package</Description>
                    </PackagingType>
                    <Description>Priority</Description>
                    <Dimensions>
                        <UnitOfMeasurement>
                            <Code>CM</Code>
                        </UnitOfMeasurement>
                        <Length>' . $length . '</Length>
                        <Width>' . $width . '</Width>
                        <Height>' . $height . '</Height>
                    </Dimensions>
                    <PackageWeight>
                        <UnitOfMeasurement>
                            <Code>KG</Code>
                        </UnitOfMeasurement>
                        <Weight>' . $weight . '</Weight>
                    </PackageWeight>
                </Package>
            </Shipment>
            <LabelSpecification>
                <LabelPrintMethod>
                    <Code>GIF</Code>
                    <Description>GIF</Description>
                </LabelPrintMethod>
                <LabelImageFormat>
                    <Code>GIF</Code>
                    <Description>GIF</Description>
                </LabelImageFormat>
            </LabelSpecification>
        </ShipmentConfirmRequest>';

        $res = Http::withBody($xml, 'text/xml')->send('POST', 'https://onlinetools.ups.com/ups.app/xml/ShipConfirm', ['verify' => false]);

        // dd($res->body());

        if ($res->status() == '200') {
            
            $xmlObject = simplexml_load_string($res->body());

            $json = json_encode($xmlObject);
            $phpArray = json_decode($json, true);

            if ($phpArray['Response'] && $phpArray['Response']['ResponseStatusDescription'] !== 'Failure') {
                if ($phpArray['GetQuoteResponse']['Note']['ActionStatus'] == "Success") {
                    if ($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp']['QtdShpExChrg']) {
                        // dd($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp']['QtdShpExChrg']);
                        foreach ($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp']['QtdShpExChrg'] as $item) {
                            if ($item['GlobalServiceName'] == "REMOTE AREA DELIVERY") {
                                return (int)$item['ChargeValue'];
                            }
                        }
                    }
                }
            }
        }

        return 0;
    }

    public function fedex(Search $search, $weight, $length, $height, $width)
    {
        $xml = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns="http://fedex.com/ws/rate/v28">
        <SOAP-ENV:Body>
           <RateRequest>
              <WebAuthenticationDetail>
                 <UserCredential>
                    <Key>dL27EA1BazynE8t6</Key>
                    <Password>mLjOx6A6YCu45dzBtnlU4huef</Password>
                 </UserCredential>
              </WebAuthenticationDetail>
              <ClientDetail>
                 <AccountNumber>988895997</AccountNumber>
                 <MeterNumber>113821960</MeterNumber>
              </ClientDetail>
              <TransactionDetail>
                 <CustomerTransactionId>*** Transaction ***</CustomerTransactionId>
              </TransactionDetail>
              <Version>
                 <ServiceId>crs</ServiceId>
                 <Major>28</Major>
                 <Intermediate>0</Intermediate>
                 <Minor>0</Minor>
              </Version>
              <ReturnTransitAndCommit>true</ReturnTransitAndCommit>
              <RequestedShipment>
                 <ShipTimestamp>2023-01-31T19:04:44+00:00</ShipTimestamp>
                 <DropoffType>REGULAR_PICKUP</DropoffType>
                 <PackagingType>YOUR_PACKAGING</PackagingType>
                 <PreferredCurrency>DHS</PreferredCurrency>
                 <Shipper>
                    <Address>
                       <PostalCode>' . $search->from_pin . '</PostalCode>
                       <CountryCode>' . $search->fromCountry->code . '</CountryCode>
                    </Address>
                 </Shipper>
                 <Recipient>
                    <Address>
                       <City>' . $search->to_city . '</City>
                       <StateOrProvinceCode/>
                       <PostalCode>' . $search->to_pin . '</PostalCode>
                       <CountryCode>' . $search->toCountry->code . '</CountryCode>
                       <Residential>false</Residential>
                    </Address>
                 </Recipient>
                 <ShippingChargesPayment>
                    <PaymentType>SENDER</PaymentType>
                    <Payor>
                       <ResponsibleParty>
                          <AccountNumber>988895997</AccountNumber>
                       </ResponsibleParty>
                    </Payor>
                 </ShippingChargesPayment>
                 <SpecialServicesRequested/>

                 <RateRequestTypes>NONE</RateRequestTypes>
                 <PackageCount>' . $search->number_of_pieces . '</PackageCount>
                 <RequestedPackageLineItems>
                    <SequenceNumber>1</SequenceNumber>
                    <GroupNumber>1</GroupNumber>
                    <GroupPackageCount>1</GroupPackageCount>
                    <Weight>
                       <Units>KG</Units>
                       <Value>' . $weight . '</Value>
                    </Weight>
                    <Dimensions>
                       <Length>' . $length . '</Length>
                       <Width>' . $width . '</Width>
                       <Height>' . $height . '</Height>
                       <Units>CM</Units>
                    </Dimensions>
                 </RequestedPackageLineItems>
              </RequestedShipment>
           </RateRequest>
        </SOAP-ENV:Body>
     </SOAP-ENV:Envelope>';

        $res = Http::withBody($xml, 'text/xml')->send('POST', 'https://ws.fedex.com:443/web-services', ['verify' => false]);

        if ($res->status() == '200') {
            $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $res->body());
            $xml = new SimpleXMLElement($response);
            $body = $xml->xpath('//SOAP-ENV:Body')[0];
            $array = json_decode(json_encode((array)$body), TRUE);

            if ($array['RateReply']['RateReplyDetails']) {
                foreach ($array['RateReply']['RateReplyDetails'] as $reply) {

                    if ($reply['RatedShipmentDetails']['ShipmentRateDetail']['Surcharges']) {
                        foreach ($reply['RatedShipmentDetails']['ShipmentRateDetail']['Surcharges'] as $surcharge) {
                            if ($surcharge['SurchargeType'] == 'OUT_OF_DELIVERY_AREA') {
                                return (int)$surcharge['Amount']['Amount'];
                            }
                        }
                    }
                }
            }
        }

        return 0;
    }

    public function db($from_address, $to_address)
    {
    }
}

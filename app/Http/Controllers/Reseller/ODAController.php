<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Integrators\Integrator;
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
    public function checkODA($integrator, Search $search, $billable_weight)
    {
        $charge = 0;

        $weight = $billable_weight;
        $length = 0;
        $height = 0;
        $width = 0;

        foreach ($search->items as $item) {
            $length += $item->length;
            $height += $item->height;
            $width += $item->width;
        }

        switch ($integrator->internal_code) {
            case 'dhl':
                $charge = $this->dhl($search, $weight, $length, $height, $width);
                break;

            case 'fedex':
                $charge = $this->fedex($integrator, $search, $weight, $length, $height, $width);
                break;

            case 'ups':
                $charge = $this->ups($search, $weight, $length, $height, $width);
                break;

            default:
                // $charge = $this->ups($search, $weight, $length, $height, $width);
                break;
        }

        return $charge;
    }

    public function dhl(Search $search, $weight)
    {
        if ($search->shipment_type == 'import') {
            $acc_no = 961091970;
        } else {
            $acc_no = 454005062;
        }

        $xml = '<?xml version="1.0" encoding="utf-8"?>
        <p:DCTRequest xmlns:p="http://www.dhl.com" xmlns:p1="http://www.dhl.com/datatypes" xmlns:p2="http://www.dhl.com/DCTRequestdatatypes" schemaVersion="2.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com DCT-req.xsd">
          <GetQuote>
            <Request>
              <ServiceHeader>
                <MessageTime>2022-07-26T12:41:22+04:00</MessageTime>
                <MessageReference>12121200000000000001000186352</MessageReference>
                <SiteID>v62_lkUvO4atNP</SiteID>
                <Password>LYaftKZUVl</Password>
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
              <PaymentAccountNumber>' . $acc_no . '</PaymentAccountNumber>
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

            // dd($phpArray);

            if (isset($phpArray['GetQuoteResponse'])) {
                if ($phpArray['GetQuoteResponse']['Note']['ActionStatus'] == "Success") {

                    if (isset($phpArray['GetQuoteResponse']['Note']['Condition']) && $phpArray['GetQuoteResponse']['Note']['Condition']['ConditionCode'] == '410301') {
                        return [];
                    }

                    if (isset($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp']['QtdShpExChrg'])) {
                        foreach ($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp']['QtdShpExChrg'] as $item) {
                            if (
                                isset($item['GlobalServiceName']) &&
                                ($item['GlobalServiceName'] == "REMOTE AREA DELIVERY" || $item['GlobalServiceName'] == "REMOTE AREA PICKUP")
                            ) {
                                return array('oda' => (float)$item['ChargeValue']);
                            }
                        }
                    } else if (isset($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp'])) {
                        foreach ($phpArray['GetQuoteResponse']['BkgDetails']['QtdShp'] as $item) {
                            if (isset($item['QtdShpExChrg'])) {
                                if (is_array($item['QtdShpExChrg'])) {
                                    foreach ($item['QtdShpExChrg'] as $charge) {
                                        if (
                                            isset($charge['GlobalServiceName']) &&
                                            ($charge['GlobalServiceName'] == "REMOTE AREA DELIVERY" || $charge['GlobalServiceName'] == "REMOTE AREA PICKUP")
                                        ) {
                                            return array('oda' => (float)$charge['ChargeValue']);
                                        }
                                    }
                                } else {
                                    if (
                                        isset($item['GlobalServiceName']) &&
                                        ($item['GlobalServiceName'] == "REMOTE AREA DELIVERY" || $item['GlobalServiceName'] == "REMOTE AREA PICKUP")
                                    ) {
                                        return array('oda' => (float)$item['ChargeValue']);
                                    }
                                }
                            }
                        }
                    } else {
                        return array('error' => true);
                    }
                } else {
                    return array('error' => true);
                }
            }
        }

        return [];
    }

    public function ups(Search $search, $weight, $length, $height, $width)
    {
        $url = "https://onlinetools.ups.com/ups.app/xml/ShipConfirm";

        $pin = 0;
        $provice_code = '';

        if ($search->toCountry->code !== 'AE') {
            $from_country = $search->fromCountry->code;
            $from_city = $search->from_city;
            $from_pin = $search->from_pin;

            $to_country =  $search->toCountry->code;
            $to_city =  $search->to_city;
            $to_pin =  $search->to_pin;
        } else {
            $to_country = $search->fromCountry->code;
            $to_city = $search->from_city;
            $to_pin = $search->from_pin;

            $from_country =  $search->toCountry->code;
            $from_city =  $search->to_city;
            $from_pin =  $search->to_pin;
        }

        if ($to_country == 'US') {
            $pin = $to_pin;
        }
        if ($from_country == 'US') {
            $pin = $from_pin;
        }

        if ($pin != 0) {
            $res = Http::send('POST', "http://postalcode.parseapi.com/api/885ca868ff01a9f6ddc424d2d0a84cac/$pin", ['verify' => false]);
            if ($res->status() == '200') {
                $json = json_decode($res->body());
                if (isset($json->state)) {
                    $provice_code = $json->state->alpha2;
                }
            }
        }

        // dd($provice_code);

        $xml = "<?xml version='1.0'?>
        <AccessRequest xml:lang='en-US'>
            <AccessLicenseNumber>4DB0A329A26C3492</AccessLicenseNumber>
            <UserId>universalexp</UserId>
            <Password>Linexdubai123@</Password>
        </AccessRequest>
        <?xml version='1.0'?>
        <ShipmentConfirmRequest xml:lang='en-US'>
            <Request>
                <TransactionReference>
                    <CustomerContext>universalexp</CustomerContext>
                </TransactionReference>
                <RequestAction>ShipConfirm</RequestAction>
                <RequestOption>validate</RequestOption>
                <SubVersion>1601</SubVersion>
            </Request>
            <Shipment>
                <Shipper>
                    <Name>universalexp</Name>
                    <AttentionName>universalexp</AttentionName>
                    <CompanyDisplayableName>universalexp</CompanyDisplayableName>
                    <PhoneNumber>971-562979199</PhoneNumber>
                    <ShipperNumber>W7583F</ShipperNumber>
                    <TaxIdentificationNumber>1234567877</TaxIdentificationNumber>
                    <Address>
                        <AddressLine1>universalexp</AddressLine1>
                        <City>Dubai</City>
                        <PostalCode>0</PostalCode>
                        <CountryCode>AE</CountryCode>
                    </Address>
                </Shipper>
                <ShipTo>
                    <CompanyName>Universal</CompanyName>
                    <AttentionName>Universal</AttentionName>
                    <PhoneNumber>1234567890</PhoneNumber>
                    <Address>
                        <AddressLine1>$to_city</AddressLine1>
                        <City>$to_city</City>
                        <PostalCode>$to_pin</PostalCode>";

        if ($to_country == 'US' && $provice_code !== '') {
            $xml .= '<StateProvinceCode>' . $provice_code . '</StateProvinceCode>';
        }

        $xml .= "<CountryCode>$to_country</CountryCode>
                    </Address>
                </ShipTo>
                <ShipFrom>
                    <CompanyName>Tomsher</CompanyName>
                    <AttentionName>Tomsher</AttentionName>
                    <PhoneNumber>505491096</PhoneNumber>
                    <Address>
                        <AddressLine1>$from_city</AddressLine1>
                        <City>$from_city</City>
                        <PostalCode>$from_pin</PostalCode>";

        if ($from_country == 'US' && $provice_code !== '') {
            $xml .= '<StateProvinceCode>' . $provice_code . '</StateProvinceCode>';
            $xml .= '\n';
        }
        $xml .= "<CountryCode>$from_country</CountryCode>
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
                    <Code>65</Code>
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
                        <Length>$length</Length>
                        <Width>$width</Width>
                        <Height>$height</Height>
                    </Dimensions>
                    <PackageWeight>
                        <UnitOfMeasurement>
                            <Code>KGS</Code>
                        </UnitOfMeasurement>
                        <Weight>$weight</Weight>
                    </PackageWeight>
                </Package>
                <Description>
                    Hello
                </Description>
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
        </ShipmentConfirmRequest>";


        $res = Http::withBody($xml, 'text/xml')
            ->send('POST', 'https://onlinetools.ups.com/ups.app/xml/ShipConfirm', [
                'verify' => false
            ]);

        if ($res->status() == '200') {

            $xmlObject = simplexml_load_string($res->body());

            $json = json_encode($xmlObject);
            $phpArray = json_decode($json, true);

            // dd(array($xml, $phpArray));

            if ($phpArray['Response'] && $phpArray['Response']['ResponseStatusDescription'] !== 'Failure') {
                if (isset($phpArray['ShipmentCharges']) && isset($phpArray['ShipmentCharges']['ItemizedCharges'])) {
                    if (isset($phpArray['ShipmentCharges']['ItemizedCharges'][0])) {
                        foreach ($phpArray['ShipmentCharges']['ItemizedCharges'] as $item) {
                            if ($item['Code'] == '190') {
                                return array('oda' => $item['MonetaryValue']);
                            }
                        }
                    } else {
                        if (
                            isset($phpArray['ShipmentCharges']['ItemizedCharges']['Code']) &&
                            $phpArray['ShipmentCharges']['ItemizedCharges']['Code'] == '190'
                        ) {
                            return array('oda' => $phpArray['ShipmentCharges']['ItemizedCharges']['MonetaryValue']);
                        }
                    }
                }
            } else {
                return array('error' => true);
            }
        }

        return [];
    }

    public function fedex(Integrator $integrator, Search $search, $weight, $length, $height, $width)
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

        $rate = array();

        if ($res->status() == '200') {
            $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $res->body());
            $xml = new SimpleXMLElement($response);
            $body = $xml->xpath('//SOAP-ENV:Body')[0];
            $array = json_decode(json_encode((array)$body), TRUE);

            $int_code = '';
            if ($integrator->integrator_code == 'fedex-ip') {
                $int_code = 'FEDEX_INTERNATIONAL_PRIORITY';
            } else {
                $int_code = 'INTERNATIONAL_ECONOMY';
            }

            if (isset($array['RateReply']) && isset($array['RateReply']['RateReplyDetails'])) {
                if ($array['RateReply']['RateReplyDetails']) {
                    foreach ($array['RateReply']['RateReplyDetails'] as $reply) {
                        if ($int_code ==  $reply['ServiceType']) {
                            if ($reply['RatedShipmentDetails']['ShipmentRateDetail']['Surcharges']) {
                                foreach ($reply['RatedShipmentDetails']['ShipmentRateDetail']['Surcharges'] as $surcharge) {
                                    if ($surcharge['SurchargeType'] == 'OUT_OF_DELIVERY_AREA' || $surcharge['SurchargeType'] == 'OUT_OF_PICKUP_AREA') {
                                        $rate['oda'] = (float)$surcharge['Amount']['Amount'];
                                    }
                                }
                            }
                            if ($reply['RatedShipmentDetails']['ShipmentRateDetail']['FuelSurchargePercent']) {
                                $rate['fsc'] = (float)$reply['RatedShipmentDetails']['ShipmentRateDetail']['FuelSurchargePercent'];
                            } else {
                                $rate['fsc'] = null;
                            }
                        }
                    }
                }
            } else {
                return array('error' => true);
            }
        }

        return $rate;
    }

    public function db($from_address, $to_address)
    {
    }
}

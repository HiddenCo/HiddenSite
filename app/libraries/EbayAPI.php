<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/18/14
 * Time: 12:47 AM
 */

include_once('ebayConfig.php');

class EbayAPI {
    function __construct()
    {

    }
    // Function to call the Trading API AddItem
    public  static  function AddItem($addTitle, $addCatID, $addSPrice, $addPicture, $addDesc,$addZIP) {

        $user_setting=UserSettings::getUserSetting();

        $country=$user_setting->lang=='com'?'US':'GB';
        $currency=$user_setting->lang=='com'?'USD':'GBP';
        $site_id=$user_setting->lang=='com'?0:3;
        /* Sample XML Request Block for minimum AddItem request
        see ... for sample XML block given length*/

        // create the XML request
        $xmlRequest  = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $xmlRequest .= "<AddItemRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">";
        $xmlRequest .= "<RequesterCredentials>";
        $xmlRequest .= "<eBayAuthToken>".$user_setting->token."</eBayAuthToken>";
        $xmlRequest .= "</RequesterCredentials>";
        $xmlRequest .= "<ErrorLanguage>en_US</ErrorLanguage>";
        $xmlRequest .= "<WarningLevel>High</WarningLevel>";
        $xmlRequest .= "<Item>";
        $xmlRequest .= "<Title>" . $addTitle . "</Title>";
        $xmlRequest .= "<Description>" . $addDesc . "</Description>";
        $xmlRequest .= "<PrimaryCategory>";
        $xmlRequest .= "<CategoryID>" . $addCatID . "</CategoryID>";
        $xmlRequest .= "</PrimaryCategory>";
        $xmlRequest .= "<StartPrice>" . $addSPrice . "</StartPrice>";
        $xmlRequest .= "<CategoryMappingAllowed>true</CategoryMappingAllowed>";
        $xmlRequest .= "<ConditionID>1000</ConditionID>";
        $xmlRequest .= "<Country>".$country."</Country>";
        $xmlRequest .= "<Currency>".$currency."</Currency>";
        $xmlRequest .= "<DispatchTimeMax>2</DispatchTimeMax>";
        $xmlRequest .= "<ListingDuration>Days_30</ListingDuration>";
        $xmlRequest .= "<ListingType>FixedPriceItem</ListingType>";
        $xmlRequest .= "<PaymentMethods>PayPal</PaymentMethods>";
        $xmlRequest .= "<PayPalEmailAddress>".$user_setting->paypal_email."</PayPalEmailAddress>";
        $xmlRequest .= "<PictureDetails>";
        $xmlRequest .= "<PictureURL>" . $addPicture . "</PictureURL>";
        $xmlRequest .= "</PictureDetails>";
        $xmlRequest .= "<PostalCode>" . $addZIP . "</PostalCode>";
        $xmlRequest .= "<Quantity>2</Quantity>";
        $xmlRequest .= "<ReturnPolicy>";
        $xmlRequest .= "<ReturnsAcceptedOption>ReturnsAccepted</ReturnsAcceptedOption>";
        $xmlRequest .= "<ReturnsWithinOption>Days_14</ReturnsWithinOption>";
        $xmlRequest .= "<Description>Restocking fee may apply.</Description>";
        $xmlRequest .= "<ShippingCostPaidByOption>Buyer</ShippingCostPaidByOption>";
        $xmlRequest .= "</ReturnPolicy>";
        $xmlRequest .= "<ShippingDetails>";
        $xmlRequest .= "<ShippingServiceOptions>";
        $xmlRequest .= "<ShippingServicePriority>1</ShippingServicePriority>";
        if($user_setting->lang=="com") {
            $xmlRequest .= "<ShippingService>ShippingMethodStandard</ShippingService>";
        } elseif ($user_setting->lang=="co.uk") {
            $xmlRequest .= "<ShippingService>UK_Parcelforce24</ShippingService>";
        }
        $xmlRequest .= "<ShippingServiceCost>0.00</ShippingServiceCost>";
        $xmlRequest .= "<ShippingServiceAdditionalCost>0.0</ShippingServiceAdditionalCost>";
        $xmlRequest .= "<ExpeditedService>false</ExpeditedService>";
        $xmlRequest .= "</ShippingServiceOptions>";
        $xmlRequest .= "<ExcludeShipToLocation>Asia</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>Central America and Caribbean</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>Middle East</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>Africa</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>North America</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>Oceania</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>Southeast Asia</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>South America</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>Europe</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>PO Box</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>APO/FPO</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>US Protectorates</ExcludeShipToLocation>";
        $xmlRequest .= "<ExcludeShipToLocation>Alaska/Hawaii</ExcludeShipToLocation>";
        $xmlRequest .= "</ShippingDetails>";
        $xmlRequest .= "</Item>";
        $xmlRequest .= "</AddItemRequest>";

        // define our header array for the Trading API call
        // notice different headers from shopping API and SITE_ID changes to SITEID
        $headers = array(
            'X-EBAY-API-SITEID:'.$site_id,
            'X-EBAY-API-CALL-NAME:AddItem',
            'X-EBAY-API-COMPATIBILITY-LEVEL:' . API_COMPATIBILITY_LEVEL,
            'X-EBAY-API-DEV-NAME:' . API_DEV_NAME,
            'X-EBAY-API-APP-NAME:' . API_APP_NAME,
            'X-EBAY-API-CERT-NAME:' . API_CERT_NAME,
            'Content-Type: text/xml;charset=utf-8'
        );

        // initialize our curl session
        $session  = curl_init(API_URL);

        // set our curl options with the XML request
        curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $xmlRequest);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);

        // execute the curl request
        $responseXML = curl_exec($session);
        $response=simplexml_load_string($responseXML);

        //var_dump($response); exit;


        // close the curl session
        curl_close($session);

        return $response;
    }
    private static  function MakeAPICall($xmlRequest,$apiName)
    {
        //Initialise a CURL session
        $connection = curl_init();

        //Set the endpoint to the environment desired
        curl_setopt($connection, CURLOPT_URL, API_URL);

        //Stop CURL from verifying the peer's certificate
        curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);

        //Set the HTTP Headers: an array of strings
        $headers = array ("X-EBAY-API-COMPATIBILITY-LEVEL:679",
            "X-EBAY-API-SITEID:".SITEID,
            "X-EBAY-API-CALL-NAME:" . $apiName,
            "X-EBAY-API-APP-NAME:" . API_APP_NAME,
            "X-EBAY-API-DEV-NAME:" . API_DEV_NAME,
            "X-EBAY-API-CERT-NAME:" . API_CERT_NAME,
            "Content-Type: text/xml;charset=utf-8"
        );


        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);

        //Set method as POST
        curl_setopt($connection, CURLOPT_POST, 1);

        //Set timeout
        curl_setopt($connection, CURLOPT_CONNECTTIMEOUT, 30);

        //Set it to return the transfer as a string from curl_exec
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($connection, CURLOPT_POSTFIELDS, $xmlRequest);

        // execute the curl request
        $responseXML = curl_exec($connection);

        // close the curl session
        curl_close($connection);

        // return the response XML
        return $responseXML;
    }
    public static function GetUserToken($session_id)
    {
        $xmlRequest = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $xmlRequest.= "<FetchTokenRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">";
        $xmlRequest.= "<SessionID>".$session_id."</SessionID>";
        $xmlRequest.= "</FetchTokenRequest>";
        $sessionId_xml=self::MakeAPICall($xmlRequest,'FetchToken');

        $obj=simplexml_load_string($sessionId_xml);

        if($obj->Ack=='Success') {
            return $obj->eBayAuthToken;
        } else {
            $errors=$obj->Errors;
            $msg=$errors->ShortMessage;

            throw new Exception($msg);
        }
    }
    public static function getSessionId()
    {
        $xmlRequest = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $xmlRequest.= "<GetSessionIDRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">";
        $xmlRequest.= "<RuName>".RUNAME."</RuName>";
        $xmlRequest.= "</GetSessionIDRequest>";
        $sessionId_xml=self::MakeAPICall($xmlRequest,'GetSessionID');

        $session_id=simplexml_load_string($sessionId_xml)->SessionID;

        return $session_id;
    }
    public static function getLoginURL($session_id)
    {
        return "https://signin.ebay.com/ws/eBayISAPI.dll?SignIn&runame=" . RUNAME . "&SessID=" . urlencode($session_id);
    }

} 
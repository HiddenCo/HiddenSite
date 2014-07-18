<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/18/14
 * Time: 12:47 AM
 */

class EbayAPI {
    function __construct()
    {

    }
    // Function to call the Trading API AddItem
    public  static  function AddItem($addTitle, $addCatID, $addSPrice, $addPicture, $addDesc) {

        /* Sample XML Request Block for minimum AddItem request
        see ... for sample XML block given length*/

        // Create unique id for adding item to prevent duplicate adds
        $uuid = md5(uniqid());

        // create the XML request
        $xmlRequest  = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $xmlRequest .= "<AddItemRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">";
        $xmlRequest .= "<ErrorLanguage>en_US</ErrorLanguage>";
        $xmlRequest .= "<WarningLevel>High</WarningLevel>";
        $xmlRequest .= "<Item>";
        $xmlRequest .= "<Title>" . $addTitle . "</Title>";
        $xmlRequest .= "<Description>" . $addDesc . "</Description>";
        $xmlRequest .= "<PrimaryCategory>";
        $xmlRequest .= "<CategoryID>" . $addCatID . "</CategoryID>";
        $xmlRequest .= "</PrimaryCategory>";
        $xmlRequest .= "<StartPrice>" . $addSPrice . "</StartPrice>";
        $xmlRequest .= "<ConditionID>1000</ConditionID>";
        $xmlRequest .= "<CategoryMappingAllowed>true</CategoryMappingAllowed>";
        $xmlRequest .= "<Country>US</Country>";
        $xmlRequest .= "<Currency>USD</Currency>";
        $xmlRequest .= "<DispatchTimeMax>3</DispatchTimeMax>";
        $xmlRequest .= "<ListingDuration>Days_7</ListingDuration>";
        $xmlRequest .= "<ListingType>Chinese</ListingType>";
        $xmlRequest .= "<PaymentMethods>PayPal</PaymentMethods>";
        $xmlRequest .= "<PayPalEmailAddress>yourpaypal@emailaddress.com</PayPalEmailAddress>";
        $xmlRequest .= "<PictureDetails>";
        $xmlRequest .= "<PictureURL>" . $addPicture . "</PictureURL>";
        $xmlRequest .= "</PictureDetails>";
        $xmlRequest .= "<PostalCode>05485</PostalCode>";
        $xmlRequest .= "<Quantity>1</Quantity>";
        $xmlRequest .= "<ReturnPolicy>";
        $xmlRequest .= "<ReturnsAcceptedOption>ReturnsAccepted</ReturnsAcceptedOption>";
        $xmlRequest .= "<RefundOption>MoneyBack</RefundOption>";
        $xmlRequest .= "<ReturnsWithinOption>Days_30</ReturnsWithinOption>";
        $xmlRequest .= "<Description>" . $addDesc . "</Description>";
        $xmlRequest .= "<ShippingCostPaidByOption>Buyer</ShippingCostPaidByOption>";
        $xmlRequest .= "</ReturnPolicy>";
        $xmlRequest .= "<ShippingDetails>";
        $xmlRequest .= "<ShippingType>Flat</ShippingType>";
        $xmlRequest .= "<ShippingServiceOptions>";
        $xmlRequest .= "<ShippingServicePriority>1</ShippingServicePriority>";
        $xmlRequest .= "<ShippingService>USPSMedia</ShippingService>";
        $xmlRequest .= "<ShippingServiceCost>2.50</ShippingServiceCost>";
        $xmlRequest .= "</ShippingServiceOptions>";
        $xmlRequest .= "</ShippingDetails>";
        $xmlRequest .= "<Site>US</Site>";
        $xmlRequest .= "<UUID>" . $uuid . "</UUID>";
        $xmlRequest .= "</Item>";
        $xmlRequest .= "<RequesterCredentials>";
        $xmlRequest .= "<eBayAuthToken>" . AUTH_TOKEN . "</eBayAuthToken>";
        $xmlRequest .= "</RequesterCredentials>";
        $xmlRequest .= "<WarningLevel>High</WarningLevel>";
        $xmlRequest .= "</AddItemRequest>";

        // define our header array for the Trading API call
        // notice different headers from shopping API and SITE_ID changes to SITEID
        $headers = array(
            'X-EBAY-API-SITEID:'.SITEID,
            'X-EBAY-API-CALL-NAME:AddItem',
            'X-EBAY-API-REQUEST-ENCODING:'.RESPONSE_ENCODING,
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

        // execute the curl request
        $responseXML = curl_exec($session);

        // close the curl session
        curl_close($session);

        // return the response XML
        return $responseXML;
    }
} 
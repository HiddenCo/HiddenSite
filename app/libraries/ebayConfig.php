<?php
/********************************************
tradingConstants.php

Constants used for Trading API calls.
Replace keys and tokens with your information.

 ********************************************/

// eBay site to use - 0 = United States
DEFINE("SITEID",0);

// production vs. sandbox flag - true=production
DEFINE("FLAG_PRODUCTION",false);

// eBay Trading API version to use
DEFINE("API_COMPATIBILITY_LEVEL",779);

/* Set the Dev, App and Cert IDs
Create these on developer.ebay.com
check if need to use production or sandbox keys */
if (FLAG_PRODUCTION) {

    // PRODUCTION
    // Set the production URL for Trading API
    DEFINE("API_URL",'https://api.ebay.com/ws/api.dll');

    // Set production credentials (from developer.ebay.com)
    DEFINE("API_DEV_NAME",'<YOUR_PRODUCTION_DEV_ID>');
    DEFINE("API_APP_NAME",'<YOUR_PRODUCTION_APP_ID>');
    DEFINE("API_CERT_NAME",'<YOUR_PRODUCTION_CERT_ID>');

    // Set the auth token for the user profile used
    DEFINE("AUTH_TOKEN",'YOUR_PRODUCTION_TOKEN');

} else {

    // SANDBOX
    // Set the sandbox URL for Trading API calls
    DEFINE("API_URL",'https://api.sandbox.ebay.com/ws/api.dll');

    // Set sandbox credentials (from developer.ebay.com)
    DEFINE("API_DEV_NAME",'7b0be4d5-eee3-41e1-b241-f2c7d76ba3b7');
    DEFINE("API_APP_NAME",'Cinnamon-c45e-4ca7-a70e-6d2aafeba080');
    DEFINE("API_CERT_NAME",'98a3886d-da66-4a84-961a-ee2ec08f4bd5');

    // Set the auth token for the user profile used
    DEFINE("AUTH_TOKEN",'');
}
?>
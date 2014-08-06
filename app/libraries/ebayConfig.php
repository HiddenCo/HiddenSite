<?php
/********************************************
tradingConstants.php

Constants used for Trading API calls.
Replace keys and tokens with your information.

 ********************************************/

// eBay site to use - 0 = United States
DEFINE("SITEID",0);

// production vs. sandbox flag - true=production
DEFINE("FLAG_PRODUCTION",true);

// eBay Trading API version to use
DEFINE("API_COMPATIBILITY_LEVEL",879);

/* Set the Dev, App and Cert IDs
Create these on developer.ebay.com
check if need to use production or sandbox keys */
if (FLAG_PRODUCTION) {

    // PRODUCTION
    // Set the production URL for Trading API
    DEFINE("API_URL",'https://api.ebay.com/ws/api.dll');

    // Set production credentials (from developer.ebay.com)
    DEFINE("API_DEV_NAME",'b41e8468-cd5d-4db4-9fd0-8976de3efbf6');
    DEFINE("API_APP_NAME",'JumpToSu-9971-40dc-b0d7-95b7296d1825');
    DEFINE("API_CERT_NAME",'df3614d6-dc4c-4b7f-826d-47913f73444b');

    // Set the auth token for the user profile used

    DEFINE("RUNAME",'JumpToSuccess-JumpToSu-9971-4-davvmzpos');

} else {

    // SANDBOX
    // Set the sandbox URL for Trading API calls
    DEFINE("API_URL",'https://api.sandbox.ebay.com/ws/api.dll');

    // Set sandbox credentials (from developer.ebay.com)
    DEFINE("API_DEV_NAME",'b41e8468-cd5d-4db4-9fd0-8976de3efbf6');
    DEFINE("API_APP_NAME",'JumpToSu-9971-40dc-b0d7-95b7296d1825');
    DEFINE("API_CERT_NAME",'df3614d6-dc4c-4b7f-826d-47913f73444b');

    // Set the auth token for the user profile used

    DEFINE("RUNAME",'JumpToSuccess-JumpToSu-9971-4-davvmzpos');
}
?>
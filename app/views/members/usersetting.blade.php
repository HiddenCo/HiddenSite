@extends('layouts.default')
@section('title') Home - Listerr @endsection

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>User Settings</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo URL::to('/')?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/user">Members Area</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/user/setting">User Settings</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php
    if(!Users::isEbayLogged()) {
        $session_id=EbayAPI::getSessionId();
        $login_url=EbayAPI::getLoginURL($session_id);
    }

?>
<div class="container">
    <div class="well">

        <form role="form" method="post" action="<?php echo URL::to('/')?>/user/setting">

            <div class="form-group">
                <h4>Select your Amazon/eBay Geographic Website</h4>
                <?php if(Users::isEbayLogged()) {?>
                    <a class="btn btn-danger" href="<?php echo URL::to('/')?>/user/ebay-logout">Log-out</a>
                <?php } else {?>
                    <a class="btn btn-danger" target="_blank" href="<?php echo $login_url;?>">Log-in to eBay (required)</a>
                    <br>
                    <br> Click the button to be redirected to eBay where you will login. Once you see the success message, come back here and click the get token button below.
                    <br>
                    <br>
                    <a class="btn btn-primary" href="<?php echo URL::to('/')?>/user/ebay-token?session_id=<?php echo $session_id;?>">get Token</a>
                    <br>
                    <br><textarea class="form-control" rows="3"><?php if(isset($data)) echo $data->token;?></textarea>
                <?php }?>
            </div>
            <div class="form-group">
                <h4>Select your Amazon/eBay Geographic Website</h4>
                <select class="form-control" name="lang" id="lang">
                    <option value="com" <?php if($data->lang=='com') echo 'selected'?>>.com (United States)</option>
                    <option value="co.uk" <?php if($data->lang=='co.uk') echo 'selected'?>>.co.uk (United Kingdom)</option>
                </select>
            </div>
            <div class="form-group">
                <h4>PayPal Email</h4>
                <input class="form-control" id="paypalinput" name="paypal_email" placeholder="Enter Your PayPal Email Address" type="text"
                       value="<?php if(isset($data)) echo $data->paypal_email;?>">
            </div>
            <div class="form-group">
                <h4>ZIP Code</h4>
                <input class="form-control" id="zipinput" name="zip_code" placeholder="Enter the ZIP code you'll be using" type="text"
                       value="<?php if(isset($data)) echo $data->zip_code;?>">
            </div>

            <div class="form-group">
                <?php if(isset($error)) {?><label style="color: red" for="passinput"><?php echo $error;?></label><?php }?>
            </div>


            <button type="submit" class="btn btn-success btn-block">Save Settings</button>

        </form>
    </div>
    <div class="well">
        <div>
            <ul class="nav nav-pills nav-justified">
                <li>
                    <a href="<?php echo URL::to('/')?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/system/about">About Us</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/system/term">Terms of Service</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/system/privacy">Privacy Policy</a>
                </li>

            </ul>
        </div>

    </div>
    <p class="text-center">
        © Copyright 2014 Listerr.co - Listerr is not associated with Amazon nor eBay. Designed with
        <a href="http://getbootstrap.com">Bootstrap</a>.
    </p>
</div>
@endsection
@section('script')
@endsection
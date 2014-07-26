@extends('layouts.default')
@section('title') Home - Listerr @endsection

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Billing Settings</h1>

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
                    <a href="<?php echo URL::to('/')?>/items/billing">Billing Settings</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <form role="form" action="<?php echo URL::to('/')?>/user/billing" method="post">


                    <div class="form-group">
                        <label for="nameinput">First and Last Name</label>
                        <input class="form-control" id="name" name="name" placeholder="Your first and last name" type="text" value="<?php if(isset($data)) echo $data['name']; else echo '';?>">
                    </div>
                    <div class="form-group">
                        <label for="paypalemail">PayPal Email</label>
                        <input class="form-control" id="paypalemail" name="paypalemail" placeholder="Your PayPal email" type="email" value="<?php if(isset($data)) echo $data['paypal']; else echo '';?>">
                    </div>
                    <div class="form-group">
                        <label for="membership">Membership Level
                        </label>
                        <input class="form-control" id="membership" readonly="true" placeholder="this will say if the account is Professional or Rookie... make it read only" type="text" value="<?php if(isset($data)) echo $data['price_name']; else echo '';?>">
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
    </div>

</div>
@endsection
@section('script')
@endsection
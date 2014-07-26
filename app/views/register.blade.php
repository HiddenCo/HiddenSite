@extends('layouts.default')
@section('title') Home - Listerr @endsection

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Register</h1>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo URL::to('/')?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/user/register">Register</a>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <form role="form" action="<?php echo URL::to('/')?>/user/register" method="post">


                    <div class="form-group">
                        <label for="nameinput">First and Last Name</label>
                        <input class="form-control" id="name" name="name" placeholder="" type="text">
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email (use your PayPal Email if possible)</label>
                        <input class="form-control" id="email" name="email" placeholder="" type="text">
                    </div>
                    <div class="form-group">
                        <label for="passinput">Password</label>
                        <input class="form-control" id="password" name="password" placeholder="" type="password">
                    </div>
                    <div class="form-group">
                        <label for="passinput">Confirm Password</label>
                        <input class="form-control" id="confirm_password" name="confirm_password" placeholder="" type="password">
                    </div>
                    <div class="form-group">
                        <?php if(isset($error)) {?><label style="color: red" for="passinput"><?php echo $error;?></label><?php }?>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Register Now!</button>
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
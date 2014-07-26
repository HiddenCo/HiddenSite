@extends('layouts.default')
@section('title') Demo - Listerr @endsection

@section('style')
<style type="text/css">
    .embed-responsive {
        position: relative;
        display: block;
        height: 0;
        padding: 0;
        overflow: hidden;
    }
    .embed-responsive .embed-responsive-item,
    .embed-responsive iframe,
    .embed-responsive embed,
    .embed-responsive object {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    .embed-responsive.embed-responsive-16by9 {
        padding-bottom: 56.25%;
    }
    .embed-responsive.embed-responsive-4by3 {
        padding-bottom: 75%;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">


                <img src="http://listerr.co/images/Listerr-Logo-50.png" class="img-responsive center-block">
                <div class="embed-responsive embed-responsive-16by9" style="margin: 15px 0px 15px 0px;">
                    <iframe width="640" height="480" src="http://www.youtube.com/embed/zpOULjyy-n8?rel=0?autoplay=1" class="embed-responsive-item" allowfullscreen></iframe>
                </div>


                <p style="text-align:center">Ever wish you could have more free time in your life?  Now you can with our *almost* fully automated drop-shipping listing system.  Automatically retrieving item information quickly creates your eBay listing.  However, when you can click a button and automatically upload the item to your eBay account, you've got something special.  You've got a tool that kicks ass.  Welcome to Listerr.</p>
                <a href="<?php echo URL::to('/')?>/pricing" class="btn btn-success btn-block btn-lg">See Pricing!</a>
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
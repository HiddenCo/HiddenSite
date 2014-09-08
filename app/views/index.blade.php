@extends('layouts.default')
@section('title') Home - Listerr @endsection

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dismissable alert-success">
                <strong>Good news!</strong>&nbsp; We are in pre-launch, so you can be amongst the first to use the tool when released.</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <div class="well">

                    <img src="http://listerr.co/images/Listerr-Logo-1.png" class="img-responsive center-block">
                </div>



                <p style="text-align:center">Welcome to Listerr, where we make drop-shipping easy. Our training tools will speed up your drop-shipping and make you look like the professional that you are.</p>

                <a href="<?php echo URL::to('/')?>/demo" class="btn btn-danger btn-block btn-lg">Check It Out!</a>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <h2>Efficiency</h2>
            <p>Our tools are designed to speed up the process of drop-shipping items to eBay. If you're using Amazon, you can simply enter the item ID and the information will automatically be retrieved. If you're using another product source, you can easily
                copy and paste the information into our tool.</p>

        </div>
        <div class="col-md-4">
            <h2>Professionalism</h2>
            <p>We wanted to provide our users with professional-looking descriptions on all of their listings. You can choose your description theme to be used in your product-description section of the eBay listing.</p>

        </div>
        <div class="col-md-4">
            <h2>Automation</h2>
            <p>Tired of going through the pages and pages to list something on eBay, when you just want to post your item? Problem solved. When you're done modifying the detials of your item within our tool, all you have to do is click a button and it's on eBay!
                No more repetitive eBay posting.</p>

        </div>
        <div class="col-md-12">
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
@extends('layouts.default')
@section('title') Home - Listerr @endsection

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>About Us</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo URL::to('/')?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/system/about">About Us</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <p>The idea of Listerr started back in May, 2014.  One of the founders (Zach) was into listing items on eBay and felt as if he wasn't time efficient.  He first coded something like Listerr using Visual Basic.  However, we wanted Listerr to be web-based so anyone could use it.</p>
                <h3>Introducing Aaron...</h3>
                <p>Aaron is a techy enthuastic startup lover. You'll often see him asking for feedback on his products so he can improve it further and get it closer to perfection. Inside of Listerr, he's CEO and a co-founder and in his spare time he likes to play online games and work with other startups on improving their products.</p>
                <h3>Introducing Zach...</h3>
                <p>Zach likes to market, network, and help others grow their business.  He's been in this industry for several years now and has come a long way.  Zach came up with the idea for Listerr after spending hours listing just a few items on eBay.  He spends his time working on his businesses or hanging out with family and friends.</p>
                <h3>Introducing Michael...</h3>
                <p>Michael is talent in information technology field of Viet Nam. You will have some good suggests for your system if you talk with him.</p>

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
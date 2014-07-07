@extends('layouts.default')
@section('title') Pricing - Listerr @endsection

@section('style')
<style type="text/css">

    .flat .plan {
        border-radius: 6px;
        list-style: none;
        padding: 0 0 20px;
        margin: 0 0 15px;
        background: #f5f5f5;
        text-align: center;
    }
    .flat .plan li {
        padding: 10px 15px;
        color: #000;
        font-size:16px;
        border-top: 1px solid #f5f5f5;
        -webkit-transition: 300ms;
        transition: 300ms;
    }
    .flat .plan li.plan-price {
        border-top: 0;
        font-size: 24px;
    }
    .flat .plan li.plan-name {
        border-radius: 6px 6px 0 0;
        padding: 15px;
        font-size: 36px;
        line-height: 24px;
        color: #fff;
        background-color: #d9534f;

        margin-bottom: 30px;
        border-top: 0;
    }
    .flat .plan li > strong {
        color: #e74c3c;
    }
    .flat .plan li.plan-action {
        margin-top: 10px;
        border-top: 0;
    }
    .flat .plan.featured {
        /*//-webkit-transform: scale(1.1);
       // -ms-transform: scale(1.1);
       // transform: scale(1.1);*/
    }
    .flat .plan.featured li.plan-name {
        background: #000;
    }
    .flat .plan.featured:hover li.plan-name {
        background: #c0392b;
    }
    .flat .plan:hover li.plan-name {
        background: #000;
    }
    #footer {
        margin-top: 100px;
        padding-bottom: 30px;
    }

</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Pricing</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo URL::to('/')?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/pricing">Pricing</a>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="container">

    <div class="row">



        <div class="row flat" style="margin-left: 0px;margin-right: 0px;">
            <div class="col-lg-6 col-md-6 col-xs-6">
                <ul class="plan plan1">
                    <li class="plan-name">
                        Rookie
                    </li>
                    <li class="plan-price">
                        <strong>$9.95</strong> / month
                    </li>
                    <li>
                        <strong>30 Listings</strong> / month
                    </li>
                    <li>
                        <strong>1</strong> Description Template
                    </li>
                    <li class="plan-action">
                        <a href="#" class="btn btn-danger btn-block btn-lg">Get It Now!</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-6">
                <ul class="plan plan2 featured">
                    <li class="plan-name">
                        Professional
                    </li>

                    <li class="plan-price">
                        <strong>$19.95</strong> / month
                    </li>
                    <li>
                        <strong>Unlimited Listings</strong>
                    </li>
                    <li>
                        <strong>10</strong> Description Templates
                    </li>
                    <li class="plan-action">
                        <a href="#" class="btn btn-danger btn-block btn-lg">Get It Now!</a>
                    </li>
                </ul>


            </div>


        </div>


    </div>
</div>
@endsection
@section('script')
@endsection
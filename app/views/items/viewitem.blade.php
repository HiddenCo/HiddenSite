@extends('layouts.default')
@section('title') Home - Listerr @endsection

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>View/Edit Item</h1>
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
                    <a href="<?php echo URL::to('/')?>/items/view">View/Edit Item</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <ul class="list-group">
                    <li class="list-group-item">
                        <b>Item Title:</b>&nbsp;Big Fancy Car</li>
                    <li class="list-group-item">
                        <b>Product Source URL:</b>&nbsp;
                        <a href="http://bigfancycar.com">http://BigFancyCar.com</a>
                    </li>
                    <li class="list-group-item">
                        <b>Buy Price:</b>&nbsp;$100,000</li>
                    <li class="list-group-item">
                        <b>Sell Price:</b>&nbsp;$200,000</li>
                    <li class="list-group-item">
                        <b>Profit:</b>&nbsp;$100,000</li>
                    <li class="list-group-item">
                        <b>Status:</b>
                        <span style="color:green">&nbsp;LIVE</span>
                    </li>
                    <li class="list-group-item">
                        <b>Date Listed:</b>&nbsp;5/9/2014 - 10:10pm EST</li>

                </ul>

                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Save to Account</button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success">Save to Account &amp; List on eBay</button>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
@section('script')
@endsection
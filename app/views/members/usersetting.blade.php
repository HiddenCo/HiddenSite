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
<div class="container">
    <div class="well">

        <form role="form">

            <div class="form-group">
                <label for="paypalinput">PayPal Email</label>
                <input class="form-control" id="paypalinput" placeholder="Enter Your PayPal Email Address" type="text">
                <br><a class="btn btn-danger">Log-in to eBay (required)</a> Logged in? Yes/No
            </div>
            <div class="form-group">
                <label for="zipinput">ZIP Code</label>
                <input class="form-control" id="zipinput" placeholder="Enter the ZIP code you'll be using" type="text">
            </div>

            <h3 class="text-left text-danger">Extremely Important:</h3>


            <div class="form-group">
                <label for="awsinput">Amazon AWS Access Key ID</label>
                <input class="form-control" id="awsinput" placeholder="Enter your Amazon AWS access key ID" type="text">
            </div>
            <div class="form-group">
                <label for="secretinput">Amazon AWS Secret Key ID</label>
                <input class="form-control" id="secretinput" placeholder="Enter your Amazon AWS secret access key ID" type="text">
            </div>
            <div class="form-group">
                <label for="atinput">Amazon Associate Tag</label>
                <input class="form-control" id="atinput" placeholder="Enter your Amazon associate tag" type="text">
            </div>
            <div class="form-group">
                <label for="imgurinput">Imgur Client ID</label>
                <input class="form-control" id="imgurinput" placeholder="Enter Imgur Client ID" type="text">
            </div>


            <button type="button" class="btn btn-success btn-block">Save Settings</button>

        </form>
    </div>
</div>
@endsection
@section('script')
@endsection
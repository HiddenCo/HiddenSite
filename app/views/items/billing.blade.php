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

                <form role="form">


                    <div class="form-group">
                        <label for="nameinput">First and Last Name</label>
                        <input class="form-control" id="nameinput" placeholder="Your first and last name" type="text">
                    </div>
                    <div class="form-group">
                        <label for="paypalemail">PayPal Email</label>
                        <input class="form-control" id="paypalemail" placeholder="Your PayPal email" type="text">
                    </div>
                    <div class="form-group">
                        <label for="membership">Membership Level
                        </label>
                        <input class="form-control" id="membership" placeholder="this will say if the account is Professional or Rookie... make it read only" type="text">
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Save Settings</button>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
@endsection
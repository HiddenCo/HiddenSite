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

                <form role="form">


                    <div class="form-group">
                        <label for="nameinput">First and Last Name</label>
                        <input class="form-control" id="nameinput" placeholder="" type="text">
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email (use your PayPal Email if possible)</label>
                        <input class="form-control" id="email" placeholder="" type="text">
                    </div>
                    <div class="form-group">
                        <label for="passinput">Password</label>
                        <input class="form-control" id="passinput" placeholder="" type="text">
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Register Now!</button>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
@endsection
@extends('layouts.default')
@section('title') Home - Listerr @endsection

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Login</h1>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo URL::to('/')?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo URL::to('/')?>/user/login">Login</a>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <form role="form" action="<?php echo URL::to('/')?>/user">


                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input class="form-control" id="email" placeholder="" type="text">
                    </div>
                    <div class="form-group">
                        <label for="passinput">Password</label>
                        <input class="form-control" id="passinput" placeholder="" type="text">
                    </div>


                    <button type="submit" class="btn btn-success btn-block">Login</button>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
@endsection
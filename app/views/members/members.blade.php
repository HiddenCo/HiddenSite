@extends('layouts.default')
@section('title') Home - Listerr @endsection

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Members Area</h1>
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
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Where do you want to go?</h1>
                <p>We make drop-shipping easy. Our training tools will speed up your drop-shipping and make you look like the professional that you are.</p>

                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <a href="<?php echo URL::to('/')?>/items" class="btn btn-success">List an Item</a>
                    </div>
                    <div class="btn-group">
                        <a href="<?php echo URL::to('/')?>/user/setting" class="btn btn-warning">Change Settings</a>
                    </div>
                    <div class="btn-group">
                        <a href="<?php echo URL::to('/')?>/items/billing" class="btn btn-danger">Upgrade Plan / Billing Settings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h1>Your Saved Items</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <table class="table">
                    <thead>
                    <tr>
                        <th>Select Items</th>
                        <th>Item Name</th>
                        <th>Product Source URL</th>
                        <th>Buy Price | Sell Price | Profit</th>
                        <th>Status</th>
                        <th>Edit Item</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" value="">
                            </div>
                        </td>
                        <td>Big Fancy Car</td>
                        <td>http://BigFancyCar.com</td>
                        <td>$100,000 | $200,000 | $100,000</td>
                        <td>
                            <span style="color:green">LIVE</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs">Edit Item</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" value="">
                            </div>
                        </td>
                        <td>Big Fancy Car</td>
                        <td>http://BigFancyCar.com</td>
                        <td>$100,000 | $200,000 | $100,000</td>
                        <td>
                            <span style="color:green">LIVE</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs">Edit Item</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" value="">
                            </div>
                        </td>
                        <td>Big Fancy Car</td>
                        <td>http://BigFancyCar.com</td>
                        <td>$100,000 | $200,000 | $100,000</td>
                        <td>
                            <span style="color:green">LIVE</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs">Edit Item</button>
                        </td>
                    </tr>

                    </tbody>

                </table>
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success">List on eBay</button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger">Delete from Account</button>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
@section('script')
@endsection
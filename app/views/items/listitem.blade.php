@extends('layouts.default')
@section('title') Home - Listerr @endsection

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>List an Item</h1>
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
                    <a href="<?php echo URL::to('/')?>/items">List an Item</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="well">


        <form role="form">

            <div class="form-group">
                <label for="amazoninput">Amazon ID</label>
                <input class="form-control" id="amazoninput" placeholder="Enter Amazon ID" type="text">
            </div>
            <div class="form-group">
                <label for="featuresinput">Features</label>
                <input class="form-control" id="featuresinput" placeholder="Enter Product Features (one per line)" type="text">
            </div>
            <div class="form-group">
                <label for="descinput">Description</label>
                <input class="form-control" id="descinput" placeholder="Enter Product Description" type="text">
            </div>
            <div class="form-group">
                <label for="availinput">Availability</label>
                <input class="form-control" id="availinput" placeholder="Enter Product Availablity" type="text">
            </div>
            <div class="form-group">
                <label for="imagesinput">Image URLs</label>
                <input class="form-control" id="imagesinput" placeholder="Enter Product Image URLs (separated by semicolons ';')" type="text">
            </div>
            <div class="form-group">
                <label for="titleinput">Title</label>
                <input class="form-control" id="titleinput" placeholder="Enter Product Title (for eBay)" type="text">
            </div>
            <div class="form-group">
                <label for="sellinput">Sell Price</label>
                <input class="form-control" id="sellinput" placeholder="Enter Product Sell Price (don't enter a $ sign)" type="text">
            </div>
            <div class="form-group">
                <label for="catinput">eBay Category Number -
                    <a href="http://www.ebay.com/sch/allcategories/all-categories">View Category List</a>
                </label>
                <input class="form-control" id="catinput" placeholder="Enter eBay category number for the item." type="text">
            </div>

            <div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Save to Account</button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-success">Save to Account &amp; List on eBay</button>
                </div>

            </div>
        </form>

    </div>


</div>
@endsection
@section('script')
@endsection
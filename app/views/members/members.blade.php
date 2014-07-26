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
                        <a href="<?php echo URL::to('/')?>/user/billing" class="btn btn-danger">Upgrade Plan / Billing Settings</a>
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
                <form role="form" action="<?php echo URL::to('/')?>/items/save-delete" method="post">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Select Items</th>
                            <th>Item Name</th>
                            <th>Product Source URL</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Edit Item</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($products as $product) {?>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input type="checkbox" name="check_list[<?php echo $product->id;?>]" value="">
                                    </div>
                                </td>
                                <td><?php echo $product->title;?></td>
                                <td><a target="_blank" href="<?php echo $product->source_url;?>">Product Link</a></td>
                                <td><?php echo '$'.$product->ebay_price;?></td>
                                <td>
                                    <?php if($product->ebay_added) {?>
                                        <span style="color:green;">LIVE</span>
                                    <?php } else {?>
                                        <span style="color:red;">Archived</span>
                                    <?php }?>
                                </td>
                                <td>
                                    <button type="button" onclick="location.href='<?php echo URL::to("/items?item_id=".$product->id);?>'" class="btn btn-primary btn-xs">Edit Item</button>
                                </td>
                            </tr>
                        <?php }?>

                        </tbody>

                    </table>
                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                            <button type="submit" name="save" id="save" class="btn btn-success">List on eBay</button>
                        </div>
                        <div class="btn-group">
                            <button type="submit" name="delete" id="delete" class="btn btn-danger">Delete from Account</button>
                        </div>

                    </div>
                </form>
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
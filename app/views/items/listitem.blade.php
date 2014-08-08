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

        <label style="color: red;" for=""><?php if(isset($error)) echo $error;?></label>
        <form role="form" action="<?php echo URL::to('/')?>/items/save<?php if(isset($product)) echo "?aws_price=".$product->aws_price;?>" method="post">

            <div class="form-group">
                <h4>ASIN</h4>
                <input class="form-control" id="amazon_id" name="amazon_id" placeholder="Enter Amazon ID" type="text" value="<?php if(isset($product))  {echo $product->amazon_id;}?>">
            </div>
            <div class="form-group">
                <h4>eBay Category Number -
                    <a target="_blank" href="http://www.ebay.com/sch/allcategories/all-categories">View Category List</a>
                </h4>
                <input class="form-control" id="category_input" name="category_input" placeholder="Enter eBay category number for the item." type="text" value="<?php if(isset($product))  {echo $product->ebay_category;}?>">
            </div>
            <div class="form-group">
                <label for="fetch">
                    <h4>
                        Retrieve the information automatically:
                    </h4>
                </label>
                <button type="submit" name="btn_autofill" class="btn btn-danger">Autofill below information</button>
            </div>
            <hr>
            <div class="form-group">
                <h4>Title</h4>
                <input class="form-control" id="title_input" name="title_input" maxlength="80" onchange="textCounter(this,'counter',80);" placeholder="Enter Product Title (for eBay)" type="text" value="<?php if(isset($product))  {echo $product->title;}?>">
                <input readonly="" class="form-control" maxlength="3" size="3" value="80 characters left" id="counter">
                <script>
                    function textCounter(field,field2,maxlimit)
                    {
                        var countfield = document.getElementById(field2);
                        if ( field.value.length > maxlimit ) {
                            field.value = field.value.substring( 0, maxlimit );
                            return false;
                        } else {
                            countfield.value = maxlimit - field.value.length;
                        }
                    }
                </script>
            </div>
            <div class="form-group">
                <label for="sellinput">
                    <h4>Pricing</h4>
                </label>
                <p>Price on Amazon: <?php if(isset($product))  {echo $product->aws_price;} else echo '0';?>.</p>
                <input class="form-control" id="sell_input" name="sell_input" placeholder="Enter Product Sell Price (don't enter a $ sign)" type="text" value="<?php if(isset($product))  {echo $product->ebay_price;}?>">
                <p>

                </p>
                <?php
                    $first=0; $second=0; $three=0;
                    if(isset($product)) {
                        $first  =round($product->aws_price*1.07*1.1494,2);
                        $second =round($product->aws_price*1.07*1.1494*1.1,2);
                        $three  =round($product->aws_price*1.07*1.1494*1.2,2);
                    }
                ?>
                <div class="btn-group">
                    <input type="button" id="even" class="btn btn-warning" value="<?php echo $first;?>">
                    <input type="button" id="10per" class="btn btn-success" value="<?php echo $second;?>">
                    <input type="button" id="20per" class="btn btn-success" value="<?php echo $three;?>">
                </div>
                <script>
                    $(document).ready(function() {
                        $("#even").click(function () {
                            $("#sell_input").val($('#even').val());
                        });

                        $("#10per").click(function () {
                            $("#sell_input").val($('#10per').val());
                        });

                        $("#20per").click(function () {
                            $("#sell_input").val($('#20per').val());
                        });
                    });

                </script>
                <p>
                    Orange is the breakeven dollar amount. The first green is a 10% increase above the breakeven, and the second is a 20% increase.
                </p>
            </div>
            <div class="form-group">
                <h4>Description</h4>
                <textarea class="form-control" id="desc_input" name="desc_input" placeholder="Enter Product Description" contenteditable="true" rows="4"><?php if(isset($product))  {echo $product->description;}?></textarea>
                <!--input class="form-control" id="desc_input" name="desc_input" placeholder="Enter Product Description" type="text" value="<!--?php if(isset($product))  {echo "\'$product->description\'";}?>"-->
            </div>
            <div class="form-group">
                <h4>Features (Bullet Points)</h4>
                <textarea class="form-control" id="features_input" name="features_input" placeholder="Enter Product Features (one per line)" contenteditable="true" rows="4"><?php if(isset($product))  {echo $product->features;}?></textarea>
                <!--input class="form-control" id="features_input" name="features_input" placeholder="Enter Product Features (one per line)" type="text" value="<!--?php if(isset($product))  {echo $product->features;}?>"-->
            </div>

            <div class="form-group">
                <h4>Availability</h4>
                <input class="form-control" id="avail_input" name="avail_input" placeholder="Enter Product Availablity" type="text" value="<?php if(isset($product))  {echo $product->availability;}?>">
            </div>
            <div class="form-group">
                <label for="imagesinput">
                    <h4>Image URL</h4>
                </label>- manually adding images? Upload images to
                <a target="_blank" href="http://imgur.com">Imgur</a>.
                <input class="form-control" id="images_input" name="images_input" placeholder="Enter Product Image URLs (separated by semicolons ';')" type="text" value="<?php if(isset($product))  {echo $product->image_urls;}?>">
            </div>
            <div class="form-group">
                <h4>Product link</h4>
                <input class="form-control" id="source_url" name="source_url" placeholder="Enter Product URL" type="text" value="<?php if(isset($product))  {echo $product->source_url;}?>">
            </div>
            <p>
                Note: other settings can be defined within the User Settings page.
            </p>
            <div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <button type="submit" name="save" class="btn btn-primary">Save to Account</button>
                </div>
                <div class="btn-group">
                    <button type="submit" name="save_post" class="btn btn-success">Save to Account &amp; List on eBay</button>
                </div>

            </div>
        </form>
        <div class="alert alert-dismissable alert-success">
            <strong>Note:</strong>While we are in beta, the settings will be: 14 day returns, "restocking fee may apply.", 30-day listing duration, Quantity: 2, Free Shipping.</div>

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
@endsection
@section('script')
@endsection
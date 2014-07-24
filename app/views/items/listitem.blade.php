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
        <form role="form" action="<?php echo URL::to('/')?>/items/save?status=<?php if(isset($product)) {echo 'update';} else {echo 'new';}?>" method="post">

            <div class="form-group">
                <label for="amazoninput">Amazon ID</label>
                <input class="form-control" id="amazon_id" name="amazon_id" placeholder="Enter Amazon ID" type="text" value="<?php if(isset($product))  {echo $product->amazon_id;}?>">
            </div>
            <div class="form-group">
                <label for="featuresinput">Features</label>
                <textarea class="form-control" id="features_input" name="features_input" placeholder="Enter Product Features (one per line)" contenteditable="true" rows="4"><?php if(isset($product))  {echo $product->features;}?></textarea>
                <!--input class="form-control" id="features_input" name="features_input" placeholder="Enter Product Features (one per line)" type="text" value="<!--?php if(isset($product))  {echo $product->features;}?>"-->
            </div>
            <div class="form-group">
                <label for="descinput">Description</label>
                <textarea class="form-control" id="desc_input" name="desc_input" placeholder="Enter Product Description" contenteditable="true" rows="4"><?php if(isset($product))  {echo $product->description;}?></textarea>
                <!--input class="form-control" id="desc_input" name="desc_input" placeholder="Enter Product Description" type="text" value="<!--?php if(isset($product))  {echo "\'$product->description\'";}?>"-->
            </div>
            <div class="form-group">
                <label for="availinput">Availability</label>
                <input class="form-control" id="avail_input" name="avail_input" placeholder="Enter Product Availablity" type="text" value="<?php if(isset($product))  {echo $product->availability;}?>">
            </div>
            <div class="form-group">
                <label for="imagesinput">Image URLs</label>
                <input class="form-control" id="images_input" name="images_input" placeholder="Enter Product Image URLs (separated by semicolons ';')" type="text" value="<?php if(isset($product))  {echo $product->image_urls;}?>">
            </div>
            <div class="form-group">
                <label for="titleinput">Title</label>
                <input class="form-control" id="title_input" name="title_input" placeholder="Enter Product Title (for eBay)" type="text" value="<?php if(isset($product))  {echo $product->title;}?>">
            </div>
            <div class="form-group">
                <label for="sellinput">Sell Price</label>
                <input class="form-control" id="sell_input" name="sell_input" placeholder="Enter Product Sell Price (don't enter a $ sign)" type="text" value="<?php if(isset($product))  {echo $product->sell_price;}?>">
            </div>
            <div class="form-group">
                <label for="catinput">eBay Category Number -
                    <a href="http://www.ebay.com/sch/allcategories/all-categories">View Category List</a>
                </label>
                <input class="form-control" id="category_input" name="category_input" placeholder="Enter eBay category number for the item." type="text" value="<?php if(isset($product))  {echo $product->ebay_category;}?>">
            </div>

            <div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <button type="submit" name="save" class="btn btn-primary">Save to Account</button>
                </div>
                <div class="btn-group">
                    <button type="submit" name="save_post" class="btn btn-success">Save to Account &amp; List on eBay</button>
                </div>

            </div>
        </form>

    </div>


</div>
@endsection
@section('script')
@endsection
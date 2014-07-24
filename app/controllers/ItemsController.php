<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/7/14
 * Time: 11:45 PM
 */

class ItemsController extends BaseController{
    public function getIndex()
    {
        $input=Input::all();
        if(isset($input['item_id'])) {
            $product=Products::getObject($input['item_id']);
            return View::make('items.listitem')->with('product',$product);
        } else {
            return View::make('items.listitem');
        }

    }
    public function getView()
    {
        return View::make('items.viewitem');
    }
    public function getBilling()
    {
        return View::make('items.billing');
    }

    public function postSave()
    {
        try
        {
            $input=Input::all();

            $amazon_id=$input['amazon_id'];

            if(strlen($amazon_id)==0) {

                return View::make('items.listitem')->with('error','Amazon Product Id is require');
            }

            $category_input=$input['category_input'];
            if(!is_numeric($category_input)) {
                // error
                return View::make('items.listitem')->with('error','Category must be number');
            }
            $product_info=self::saveItem();

            if(isset($_POST['save_post'])) {
                // post to ebay
                self::addtoEbay($product_info);
            }
            // redirect to main page
            return Redirect::to('/user');
        } catch(Exception $e) {
            return ErrorResponse::Report($e);
        }
    }
    private function saveItem()
    {
        $input=Input::all();

        $status=$input['status'];
        if($status=='new') {// add new
            $amazon_id=$input['amazon_id'];

            $category_input=$input['category_input'];

            $amazon_obj=AmazonApi::getInstance();
            $product_info=$amazon_obj->getProductInformation($amazon_id);

            $product_info['category']=$category_input;

            Products::AddNewProduct($product_info);
        } else {// update
            $product_info['product_id']=$input['amazon_id'];
            $product_info['title']=$input['title_input'];
            $product_info['category']=$input['category_input'];
            $product_info['price']=$input['sell_input'];
            $product_info['image']=$input['images_input'];
            $product_info['description']=$input['desc_input'];
            $product_info['feature']=$input['features_input'];
            $product_info['availability']=$input['avail_input'];

            Products::AddNewProduct($product_info);
        }

        return $product_info;
    }
    private function addtoEbay($product_info)
    {
        if(Products::isArchivedProduct($product_info['product_id'])) {

            // resize image first
            $img_url=$product_info['image'];

            // upload to ebay

            EbayAPI::AddItem($product_info['title'],$product_info['category'],
                $product_info['price'],$img_url,$product_info['description'],$user_setting->zip_code);

            Products::setEbayAdded($product_info['product_id']);
        }

    }

    public function getEdit()
    {
        $input=Input::all();
        if(array_key_exists('item_id',$input)) {
            $item_id=$input['item_id'];

        } else {
            return ErrorResponse::Report(new Exception('Product Id is not exist'));
        }
    }
    public function postSaveDelete()
    {
        $check_list=$_POST['check_list'];
        $products=array_keys($check_list);
        if(isset($_POST['save'])) {
            // save items
            foreach($products as $item) {

                $product=Products::getObject($item);

                EbayAPI::AddItem($product->title,$product->ebay_category,$product->sell_price,
                    $product->image_urls,$product->description);

                Products::setEbayAdded($product->amazon_id);
            }

        } else {
            foreach($products as $item) {
                Products::DeleteProduct($item);
            }
        }
        return Redirect::to('/user');
    }


} 
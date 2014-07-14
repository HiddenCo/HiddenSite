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
        return View::make('items.listitem');
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
            self::saveItem();

            if(isset($_POST['save_post'])) {
                // post to ebay
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
        $amazon_id=$input['amazon_id'];

        $category_input=$input['category_input'];

        $amazon_obj=AmazonApi::getInstance();
        $product_info=$amazon_obj->getProductInformation($amazon_id);

        $product_info['category']=$category_input;

        Products::AddNewProduct($product_info);
    }

} 
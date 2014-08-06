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

    public function postSave()
    {
        try
        {
            $input=Input::all();

            $amazon_id=$input['amazon_id'];

            if(strlen($amazon_id)==0) {

                return View::make('items.listitem')->with('error','Amazon Product Id is require');
            }

            if(isset($_POST['btn_autofill'])) {
                $product= self::getAmazonProductInformation($amazon_id);

                $product->ebay_category=$input['category_input'];

                return View::make('items.listitem')->with('product',$product);
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

        $product_info['product_id']=$input['amazon_id'];
        $product_info['title']=$input['title_input'];
        $product_info['category']=$input['category_input'];
        $product_info['price']=$input['sell_input'];
        $product_info['image']=$input['images_input'];
        $product_info['description']=$input['desc_input'];
        $product_info['feature']=$input['features_input'];
        $product_info['availability']=$input['avail_input'];

        if(array_key_exists('aws_price',$input)) {
            $product_info['aws_price']=$input['aws_price'];
        } else {
            $product_info['aws_price']=0;
        }

        Products::AddNewProduct($product_info);

        return $product_info;
    }
    private function addtoEbay($product_info)
    {
        if(Products::isArchivedProduct($product_info['product_id'])) {

            // resize image first
            $img_url=$product_info['image'];

            $user_setting=UserSettings::getUserSetting();

            // upload to ebay

            // build description to ebay
            $description="<![CDATA[<h1>".$product_info['title']."</h1>";
            $description.="<p>".$product_info['description']."</p>";
            $description.="<ul>";

            $features = explode("\n", $product_info['feature']);

            foreach($features as $feature) {
                if(strlen($feature)>0) {
                    $description.="<li>".$feature."</li>";
                }
            }
            $description.="</ul>]]>";

            $response=EbayAPI::AddItem($product_info['title'],$product_info['category'],
                $product_info['price'],$img_url,$description,$user_setting->zip_code);


            // return the response XML
            if($response->Ack=='Failure') {
                $error_str='';
                $errors=$response->Errors;

                if(is_array($errors)) {
                    foreach($errors as $error) {
                        $error_str.=$error->LongMessage."\n";
                    }
                } else {
                    $error_str.=$errors->LongMessage."\n";
                }

                throw new Exception($error_str);
            }

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
        try
        {
            $check_list=$_POST['check_list'];
            $products=array_keys($check_list);
            if(isset($_POST['save'])) {
                // save items
                foreach($products as $item) {

                    $product=Products::getObject($item);

                    $user_setting=UserSettings::getUserSetting();

                    //$description=$product->description;
                    // build description to ebay
                    $description="<![CDATA[<h1>".$product->title."</h1>";
                    $description.="<p>".$product->description."</p>";
                    $description.="<ul>";

                    $features = explode("\n", $product->features);

                    foreach($features as $feature) {
                        if(strlen($feature)>0) {
                            $description.="<li>".$feature."</li>";
                        }

                    }
                    $description.="</ul>]]>";

                    $response=EbayAPI::AddItem($product->title,$product->ebay_category,$product->ebay_price,
                        $product->image_urls,$description,$user_setting->zip_code);


                    if($response->Ack=='Failure') {
                        $error_str='';
                        $errors=$response->Errors;

                        if(is_array($errors)) {
                            foreach($errors as $error) {
                                $error_str.=$error->LongMessage."\n";
                            }
                        } else {
                            $error_str.=$errors->LongMessage."\n";
                        }

                        throw new Exception($error_str);
                    }

                    Products::setEbayAdded($product->amazon_id);
                }

            } else {
                foreach($products as $item) {
                    Products::DeleteProduct($item);
                }
            }
            return Redirect::to('/user');
        } catch(Exception $e) {
            return ErrorResponse::Report($e);
        }
    }
    private function getAmazonProductInformation($amazon_id)
    {
        $user_setting=UserSettings::getUserSetting();
        if($user_setting->lang=='com') {
            $money='$';
        } elseif($user_setting->lang=='co.uk') {
            $money='£';
        } else {
            $money='$';
        }

        $amazon_obj=AmazonApi::getInstance();
        $product_info=$amazon_obj->getProductInformation($amazon_id,$money);

        $product=new Products();
        $product->amazon_id=$amazon_id;
        $product->title=$product_info['title'];
        $product->features=$product_info['feature'];
        $product->description=$product_info['description'];
        $product->availability=$product_info['availability'];
        $product->image_urls=$product_info['image'];
        $product->aws_price=$product_info['price'];
        $product->ebay_price=$product_info['price'];
        $product->source_url=$product_info['source_url'];

        return $product;
    }


} 
<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/15/14
 * Time: 1:25 AM
 */

class Products extends Eloquent{
    public static function isExist($product_id)
    {
        $sql="select * from products where amazon_id=?";
        $result=DB::select($sql,array($product_id));
        if(count($result)>0) {
            return true;
        } else {
            return false;
        }
    }

    public static function AddNewProduct($input)
    {
        if(self::isExist($input['product_id']))
        {
            self::DeleteProduct($input['product_id']);
        }
        $sql="insert into products (created_at,user_id,amazon_id,title,features,description,availability,image_urls,sell_price,ebay_category)
                values (now(),?,?,?,?,?,?,?,?,?)";
        DB::insert($sql,array(Session::get('user_id'),$input['product_id'],$input['title'],
            $input['feature'],$input['description'],$input['availability'],$input['image'],
            $input['price'],$input['category']));
    }
    public static function DeleteProduct($product_id)
    {
        DB::delete('delete from products where amazon_id=?',array($product_id));
    }
} 
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
        $sql="select * from products where amazon_id=? and user_id=?";
        $result=DB::select($sql,array($product_id,Session::get('user_id')));
        if(count($result)>0) {
            return true;
        } else {
            return false;
        }
    }

    public static function isArchivedProduct($product_id)
    {
        $sql="select ebay_added from products where amazon_id=? and user_id=?";
        $result=DB::select($sql,array($product_id,Session::get('user_id')));

        if($result!=null && count($result)>0) {
            return $result[0]->ebay_added==0;
        } else {
            return false;
        }
    }

    public static function AddNewProduct($input)
    {
        if(self::isExist($input['product_id']))
        {
            return self::updateObject($input);
        }
        $sql="insert into products (created_at,user_id,amazon_id,title,features,description,availability,image_urls,ebay_price,ebay_category)
                values (now(),?,?,?,?,?,?,?,?,?)";
        DB::insert($sql,array(Session::get('user_id'),$input['product_id'],$input['title'],
            $input['feature'],$input['description'],$input['availability'],$input['image'],
            $input['price'],$input['category']));
    }
    public static function DeleteProduct($product_id)
    {
        DB::delete('delete from products where id=?',array($product_id));
    }

    public static function getAll($user_id)
    {
        $sql="select * from products where user_id=?";
        $result=DB::select($sql,array($user_id));

        return $result;
    }
    public static function getObject($item_id)
    {
        $sql="select * from products where id=?";
        $result=DB::select($sql,array($item_id));

        if($result!=null && count($result)>0) {
            return $result[0];
        }
    }

    public static function updateObject($input)
    {
        $sql="update products set title=?,features=?,description=?,
                availability=?,image_urls=?,ebay_price=?,ebay_category=? where amazon_id=? and user_id=?";

        DB::update($sql,array($input['title'],
            $input['feature'],$input['description'],$input['availability'],$input['image'],
            $input['price'],$input['category'],$input['product_id'],Session::get('user_id')));

    }
    public static function setEbayAdded($amazon_id) {
        $sql="update products set ebay_added=1 where amazon_id=? and user_id=?";
        DB::update($sql,array($amazon_id,Session::get('user_id')));
    }
} 
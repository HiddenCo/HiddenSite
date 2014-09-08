<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/26/14
 * Time: 11:18 PM
 */

class UserPricing extends Eloquent{
    protected $table='user_pricing';

    public static function getObject()
    {
        $user_id=Session::get('user_id');
        $sql="select * from user_pricing where user_id=?";
        $result=DB::select($sql,array($user_id));
        if(count($result)>0) {
            return $result[0];
        } else {
            return null;
        }
    }
    public static function setUserPricing($price_id)
    {
        $user_id=Session::get('user_id');
        $obj=self::getObject();
        if($obj==null) {
            // insert new
            $sql="insert into user_pricing (created_at,user_id,pricing_id) values
                    (now(),?,?)";
            DB::insert($sql,array($user_id,$price_id));
        } else {
            // update
            $sql="update user_pricing set pricing_id=? where user_id=?";
            DB::update($sql,array($price_id,$user_id));
        }
    }
}
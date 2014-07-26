<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/9/14
 * Time: 9:22 PM
 */

class UserSettings extends Eloquent {
    protected $table='user_settings';

    public static function CreateDefaultObject($user_id)
    {
        $sql="insert into user_settings (created_at,user_id) value (now(),?)";
        DB::insert($sql,array($user_id));
    }
    public static function updateSetting($input)
    {
        $user_id=Session::get('user_id');
        // update
        $sql="update user_settings set paypal_email=?, zip_code=?,lang=? where user_id=?";
        DB::update($sql,array($input['paypal_email'],$input['zip_code'],$input['lang'],$user_id));
    }
    public static function getUserSetting()
    {
        $user_id=Session::get('user_id');
        $sql="select * from user_settings where user_id=?";
        $result=DB::select($sql,array($user_id));
        if($result!=null && count($result)>0) {
            return $result[0];
        } else {
            return null;
        }
    }
    public static function updatePayaplEmail($email)
    {
        $user_id=Session::get('user_id');
        $sql="update user_settings set paypal_email=? where user_id=?";

        DB::update($sql,array($email,$user_id));
    }
} 
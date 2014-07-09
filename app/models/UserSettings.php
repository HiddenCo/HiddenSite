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
        $sql="update user_settings set paypal_email=?, zip_code=?, aws_access_key=?, aws_access_secret=?,
                aws_associate_tag=?,imgur_client_id=? where user_id=?";
        DB::update($sql,array($input['paypal_email'],$input['zip_code'],$input['access_key'],
                    $input['secret'],$input['associate_tag'],$input['imgur_id'],$user_id));
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

} 
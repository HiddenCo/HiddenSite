<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/9/14
 * Time: 8:30 PM
 */

class Users extends Eloquent{
    protected $table='users';

    public static function isExistEmail($email)
    {
        $sql="select * from users where email=?";
        $result=DB::select($sql,array($email));

        if($result!=null && count($result)>0) {
            return true;
        } else {
            return false;
        }
    }
    // register user information and return user id
    public static function registerUser($name,$email,$password)
    {
        $pwd=md5($password);
        $sql="insert into users (name,email,password,created_at) values (?,?,?,now())";
        DB::insert($sql,array($name,$email,$pwd));

        $user_id=DB::connection()->getPdo()->lastInsertId();

        Session::put('user_id',$user_id);

        // init default value for user setting
        UserSettings::CreateDefaultObject($user_id);
        UserPricing::setUserPricing(1);

        return $user_id;

    }
    public static function login($email,$pass)
    {
        $pwd=md5($pass);
        $sql="select * from users where email=? and password=?";
        $result=DB::select($sql,array($email,$pwd));

        if($result!=null && count($result)>0) {
            return $result[0];
        } else {
            return null;
        }
    }
    public static function isEbayLogged()
    {
        $user_id=Session::get('user_id');
        $sql="select token from user_settings where user_id=?";
        $result=DB::select($sql,array($user_id));
        if(count($result)>0) {
            return isset($result[0]->token);
        } else {
            return false;
        }
    }
    public static function deleteEbayToken()
    {
        $sql="update user_settings set token=null where  user_id=?";
        DB::update($sql,array(Session::get('user_id')));
    }
    public static function setEbayToken($token)
    {
        $sql="update user_settings set token=? where  user_id=?";
        DB::update($sql,array($token,Session::get('user_id')));
    }
    public static function getObject()
    {
        $user_id=Session::get('user_id');
        $sql="select * from users where id=?";
        $result=DB::select($sql,array($user_id));
        if(count($result)>0) {
            return $result[0];
        } else {
            return null;
        }
    }
    public static function updateUserName($name)
    {
        $user_id=Session::get('user_id');
        $sql="update users set name=? where id=?";
        DB::update($sql,array($name,$user_id));
    }
}
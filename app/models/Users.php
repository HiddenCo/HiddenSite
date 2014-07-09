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

        return $pdo = DB::connection()->getPdo()->lastInsertId();
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

} 
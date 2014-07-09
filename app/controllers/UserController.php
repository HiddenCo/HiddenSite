<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/7/14
 * Time: 11:23 PM
 */

class UserController extends BaseController{
    // make user register page
    public function getRegister()
    {
        return View::make('register');
    }
    //make user login view
    public function getLogin()
    {
        return View::make('login');
    }
    // make members views
    public function getIndex()
    {
        if(!Session::has('user_id')) {
            return Redirect::to('/user/login');
        }
        return View::make('members.members');
    }
    public function getSetting()
    {
        if(!Session::has('user_id')) {
            return Redirect::to('/user/login');
        }
        return View::make('members.usersetting')->with('data',UserSettings::getUserSetting());
    }
    public function postRegister()
    {
        $input=Input::all();
        if(array_key_exists('name',$input)) {
            $name=$input['name'];
            if(!isset($name) || (isset($name) && strlen($name)==0)) {
                // report error
                return View::make('register')->with('error','name is blank!');
            }
        } else {
           // report error
            return View::make('register')->with('error','have not exist name!');
        }
        if(array_key_exists('password',$input)) {
            $password=$input['password'];
            if(!isset($password) || (isset($password) && strlen($password)==0)) {
                // report error
                return View::make('register')->with('error','password is blank!');
            }
        } else {
            // report error
            return View::make('register')->with('error','have not exist password!');
        }
        if(array_key_exists('confirm_password',$input)) {
            $confirm_password=$input['confirm_password'];
            if(!isset($confirm_password)) {
                // report error
                return View::make('register')->with('error','confirm password is blank!');
            }
        } else {
            // report error
            return View::make('register')->with('error','have not exist confirm password!');
        }
        if(array_key_exists('email',$input)) {
            $email=$input['email'];
            if(!isset($email) || (isset($email) && strlen($email)==0)) {
                // report error
                return View::make('register')->with('error','email is blank!');
            }
        } else {
            // report error
            return View::make('register')->with('error','have not exist email!');
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            return View::make('register')->with('error','The email format is wrong!');
        }
        if($password!=$confirm_password) {
            return View::make('register')->with('error','password not match!');
        }

        if(Users::isExistEmail($email)) {
            return View::make('register')->with('error','The email is already exist!');
        }

        try {
            // register user
            $user_id=Users::registerUser($name,$email,$password);

            Session::put('user_id',$user_id);
            // redirect to member page
            return Redirect::to('/user');
        } catch (Exception $e) {
            return ErrorResponse::Report($e);
        }
    }
    public function postLogin()
    {
        $input=Input::all();
        if(array_key_exists('password',$input)) {
            $password=$input['password'];
            if(!isset($password) || (isset($password) && strlen($password)==0)) {
                // report error
                return View::make('login')->with('error','password is blank!');
            }
        } else {
            // report error
            return View::make('login')->with('error','have not exist password!');
        }
        if(array_key_exists('email',$input)) {
            $email=$input['email'];
            if(!isset($email) || (isset($email) && strlen($email)==0)) {
                // report error
                return View::make('login')->with('error','email is blank!');
            }
        } else {
            // report error
            return View::make('login')->with('error','have not exist email!');
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            return View::make('login')->with('error','The email format is wrong!');
        }
        try {
            // register user
            $user=Users::login($email,$password);

            if($user==null) {
                return View::make('login')->with('error','email or password is wrong!');
            }
            Session::put('user_id',$user->id);
            // redirect to member page
            return Redirect::to('/user');
        } catch (Exception $e) {
            return ErrorResponse::Report($e);
        }
    }
    public function postSetting()
    {
        $input=Input::all();
        $setting=UserSettings::getUserSetting();
        if(array_key_exists('paypal_email',$input)) {
            $paypal_email=$input['paypal_email'];
            $setting->paypal_email=$paypal_email;

            if(!isset($paypal_email) || (isset($paypal_email) && strlen($paypal_email)==0)) {
                // report error
                $data=array('data'=>$setting,'error'=>'paypal email is blank!');
                return View::make('members.usersetting',$data);
            }
        } else {
            // report error
            $data=array('data'=>$setting,'error'=>'have not exist paypal email!');
            return View::make('members.usersetting',$data);
        }

        if(!filter_var($paypal_email,FILTER_VALIDATE_EMAIL)) {
            $data=array('data'=>$setting,'error'=>'The paypal email format is wrong!');
            return View::make('members.usersetting',$data);
        }

        if(array_key_exists('zip_code',$input)) {
            $zip_code=$input['zip_code'];
            $setting->zip_code=$zip_code;
            if(!isset($zip_code) || (isset($zip_code) && strlen($zip_code)==0)) {
                // report error
                $data=array('data'=>$setting,'error'=>'zip code is blank!');
                return View::make('members.usersetting',$data);
            }
        } else {
            // report error
            $data=array('data'=>$setting,'error'=>'have not exist zip code!');
            return View::make('members.usersetting',$data);

        }

        if(array_key_exists('access_key',$input)) {
            $access_key=$input['access_key'];
            $setting->aws_access_key=$access_key;
            if(!isset($access_key) || (isset($access_key) && strlen($access_key)==0)) {
                // report error
                $data=array('data'=>$setting,'error'=>'access key is blank!');
                return View::make('members.usersetting',$data);
            }
        } else {
            // report error
            $data=array('data'=>$setting,'error'=>'have not exist access key!');
            return View::make('members.usersetting',$data);
        }

        if(array_key_exists('secret',$input)) {
            $secret=$input['secret'];
            $setting->aws_access_secret=$secret;
            if(!isset($secret) || (isset($secret) && strlen($secret)==0)) {
                // report error
                $data=array('data'=>$setting,'error'=>'secret is blank!');
                return View::make('members.usersetting',$data);
            }
        } else {
            // report error
            $data=array('data'=>$setting,'error'=>'have not exist secret!');
            return View::make('members.usersetting',$data);
        }
        if(array_key_exists('associate_tag',$input)) {
            $associate_tag=$input['associate_tag'];
            $setting->aws_associate_tag=$associate_tag;
            if(!isset($associate_tag) || (isset($associate_tag) && strlen($associate_tag)==0)) {
                // report error
                $data=array('data'=>$setting,'error'=>'associate tag is blank!');
                return View::make('members.usersetting',$data);
            }
        } else {
            // report error
            $data=array('data'=>$setting,'error'=>'have not exist associate tag!');
            return View::make('members.usersetting',$data);
        }
        if(array_key_exists('imgur_id',$input)) {
            $imgur_id=$input['imgur_id'];
            $setting->imgur_client_id=$imgur_id;
            if(!isset($imgur_id) || (isset($imgur_id) && strlen($imgur_id)==0)) {
                // report error
                $data=array('data'=>$setting,'error'=>'imgur id is blank!');
                return View::make('members.usersetting',$data);

            }
        } else {
            // report error
            $data=array('data'=>$setting,'error'=>'have not exist imgur id!');
            return View::make('members.usersetting',$data);
        }

        try {
            // register user
            UserSettings::updateSetting($input);

            // redirect to member page
            return Redirect::to('/user');
        } catch (Exception $e) {
            return ErrorResponse::Report($e);
        }
    }
} 
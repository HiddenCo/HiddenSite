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
    //make user login view
    public function getLogout()
    {
        Session::flush();
        return View::make('login');
    }
    // make members views
    public function getIndex()
    {
        if(!Session::has('user_id')) {
            return Redirect::to('/user/login');
        }
        $products=Products::getAll(Session::get('user_id'));
        return View::make('members.members')->with('products',$products);
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

        try {
            // register user
            UserSettings::updateSetting($input);

            // redirect to member page
            return Redirect::to('/user');
        } catch (Exception $e) {
            return ErrorResponse::Report($e);
        }
    }
    public function getEbayToken()
    {
        try {
            $session_id=Input::get('session_id');
            $user_token=EbayAPI::GetUserToken($session_id);

            Users::setEbayToken($user_token);

            return Redirect::to('/user/setting');
        } catch(Exception $e) {
            return ErrorResponse::Report($e);
        }

    }
    public function getEbayLogout()
    {
        try {
            Users::deleteEbayToken();
            return Redirect::to('/user/setting');
        } catch(Exception $e) {
            return ErrorResponse::Report($e);
        }

    }
    public function getBilling()
    {
        try {
            $user=Users::getObject();
            if($user!=null) {

                $user_setting=UserSettings::getUserSetting();
                $user_price=UserPricing::getObject();
                $price=Pricing::getObject($user_price->pricing_id);

                $billing=array('name'=>$user->name,'paypal'=>$user_setting->paypal_email,'price_name'=>$price->name);
                return View::make('items.billing')->with('data',$billing);
            }
        } catch(Exception $e) {
            return ErrorResponse::Report($e);
        }


    }
    public function postBilling()
    {
        try
        {
            $user=Users::getObject();

            $user_setting=UserSettings::getUserSetting();
            $user_price=UserPricing::getObject();
            $price=Pricing::getObject($user_price->pricing_id);

            $billing=array('name'=>$user->name,'paypal'=>$user_setting->paypal_email,'price_name'=>$price->name);

            $input=Input::all();
            if(array_key_exists('name',$input)) {
                $name=$input['name'];
            } else {
                // return error
                $billing['name']='';
                $data=array('data'=>$billing,'error'=>'User name is not exist!');
                return View::make('items/billing',$data);
            }
            if(strlen($name)==0) {
                $billing['name']='';
                $data=array('data'=>$billing,'error'=>'User name is not exist!');
                return View::make('items/billing',$data);
            }
            if(array_key_exists('paypalemail',$input)) {
                $paypalemail=$input['paypalemail'];
            } else {
                $billing['paypal']='';
                $data=array('data'=>$billing,'error'=>'Paypal email is not exist!');
                return View::make('items/billing',$data);
            }
            if(!filter_var($paypalemail,FILTER_VALIDATE_EMAIL)) {
                $billing['paypal']=$paypalemail;
                $data=array('data'=>$billing,'error'=>'The email format is wrong!');
                return View::make('items/billing',$data);
            }
            // save to user
            Users::updateUserName($name);
            UserSettings::updatePayaplEmail($paypalemail);

            return Redirect::to('/user/billing');
        } catch(Exception $e) {
            return ErrorResponse::Report($e);
        }


    }
} 
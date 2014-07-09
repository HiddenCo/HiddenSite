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
        return View::make('members.members');
    }
    public function getSetting()
    {
        return View::make('members.usersetting');
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

            Session::put('user_id', $user_id);

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

            Session::put('user_id', $user->id);

            // redirect to member page
            return Redirect::to('/user');
        } catch (Exception $e) {
            return ErrorResponse::Report($e);
        }
    }
} 
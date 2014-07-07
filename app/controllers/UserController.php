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
} 
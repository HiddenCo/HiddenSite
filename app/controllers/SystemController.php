<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/26/14
 * Time: 5:48 PM
 */

class SystemController extends BaseController{
    public function getTerm()
    {
        return View::make('terms');
    }
    public function getPrivacy()
    {
        return View::make('privacy');
    }
    public function getAbout()
    {
        
    }
} 
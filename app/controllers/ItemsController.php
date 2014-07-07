<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/7/14
 * Time: 11:45 PM
 */

class ItemsController extends BaseController{
    public function getIndex()
    {
        return View::make('items.listitem');
    }
    public function getView()
    {
        return View::make('items.viewitem');
    }
    public function getBilling()
    {
        return View::make('items.billing');
    }

} 
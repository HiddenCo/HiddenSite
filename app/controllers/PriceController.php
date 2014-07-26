<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/26/14
 * Time: 11:12 PM
 */

class PriceController extends BaseController{
    public function getIndex()
    {
        $id=Input::get('id');
        UserPricing::setUserPricing($id);

        return Redirect::to('/user');
    }
} 
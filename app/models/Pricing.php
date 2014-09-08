<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/26/14
 * Time: 11:16 PM
 */

class Pricing extends Eloquent{
    protected $table='pricing';
    public static function getObject($id)
    {
        $sql="select * from pricing where id=?";
        $result=DB::select($sql,array($id));
        if(count($result)>0) {
            return $result[0];
        } else {
            return null;
        }
    }
} 
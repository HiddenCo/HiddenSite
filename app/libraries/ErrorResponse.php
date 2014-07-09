<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/9/14
 * Time: 8:38 PM
 */

class ErrorResponse {
    public static function Report($exception)
    {
        return View::make('error')->with('error','ERROR: '.$exception->getMessage());
    }

} 
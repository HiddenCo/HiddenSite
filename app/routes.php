<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});
Route::get('/demo', function()
{
    return View::make('demo');
});
Route::get('/pricing', function()
{
    if(!Session::has('user_id')) {
        return Redirect::to('/user/login');
    }
    return View::make('pricing');
});

Route::get('/test',function() {
    $api=new WalmartAPI();
    $api->getProductInformation('21805448');
});

// Users
Route::Controller('user','UserController');
//Items
Route::Controller('items','ItemsController');

Route::Controller('system','SystemController');

Route::Controller('price','PriceController');
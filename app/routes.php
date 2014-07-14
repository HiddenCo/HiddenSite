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
    return View::make('pricing');
});

Route::get('/test',function() {
    $awzapi=AmazonApi::getInstance();
    $awzapi->getProductInformation('B00JQHOKSQ');
});

// Users
Route::Controller('user','UserController');
//Items
Route::Controller('items','ItemsController');
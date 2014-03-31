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
	return View::make('web.index');
});
Route::get('/about',function()
{
    return View::make('web.overons');
});
Route::get('/profiel',function()
{
    return View::make('web.profiel');
});
Route::get('/search',function()
{
    return View::make('web.spelzoeken');
});
Route::get('/game',function()
{
    return View::make('web.speldetail');
});
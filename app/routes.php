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

Route::get('/', array('uses'=>'HomeController@index'));

Route::get('login', array('uses' => 'AdminController@showLogin'));

Route::post('login', array('before' => 'csrf', 'uses' => 'AdminController@doLogin'));

Route::get('admin', array('before' => 'auth', 'uses' => 'AdminController@showAdmin'));

Route::get('logout', array('uses' => 'AdminController@doLogout'));

Route::group(array('before'=>'auth'), function() {
  Route::resource('products', 'ProductController');
});

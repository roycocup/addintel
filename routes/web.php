<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return "<h1>AddIntel Test</h1>";
});

Route::get('/post', 'PostController@index');
Route::get('/post/{post_id}', 'PostController@show');

Route::match(['get', 'post'], '/user/new', 'UserController@new');

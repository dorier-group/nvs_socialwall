<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});
Route::get('/','HomeController@index');
Route::post('show_frm','HomeController@show_frm');
Route::post('add_comment','HomeController@addComment');
Route::get('participant','HomeController@participants');
Route::post('add_particpant','HomeController@add_particpant');
Route::post('show_graph','HomeController@showGraph');
Route::post('submit_reply','HomeController@submit_reply');
Route::post('upload_file','HomeController@upload_file');
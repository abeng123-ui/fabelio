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
set_time_limit (120);

// Data Link
Route::get('/', 'LinkController@link_create')->name('link');
Route::post('link/store', 'LinkController@link_store')->name('link.store');
Route::get('link/list', 'LinkController@link_list')->name('link.list');
Route::get('link/detail/{id}', 'LinkController@link_detail')->name('link.detail');
Route::get('check_url', 'LinkController@check_url');


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
Route::get('/', 'ContentsController@home_api')->name('home');
Route::get('/list/{event_id}', 'ContentsController@list')->name('list');
Route::get('/gymnasts/{event_id}/{startno}', 'ContentsController@gymnasts')->name('gymnasts');
Route::get('/events', 'EventsController@index')->name('events');
Route::get('/event/list/{event_id}', 'EventsController@list')->name('event_list');

Route::get('/rang', 'RangController@index')->name('rang');
Route::get('/rang/list/{cat_id}', 'RangController@list')->name('rang_list');

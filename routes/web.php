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
Route::get('/', 'ContentController@homeApi')->name('home');
Route::get('/list/{event_id}', 'ContentController@list')->name('list');
Route::get('/gymnasts/{event_id}/{startno}', 'ContentController@gymnasts')->name('gymnasts');
Route::get('/events', 'EventController@index')->name('events');
Route::get('/event/list/{event_id}', 'EventController@list')->name('event_list');

Route::get('/rang/{event_id}', 'RangController@index')->name('rang');
Route::get('/rang/list/{event_id}/{cat_id}', 'RangController@list')->name('rang_list');
Route::get('/rang/gflist/{event_id}/{cat_id}/{app_id}', 'RangController@gflist')->name('rang_gflist');

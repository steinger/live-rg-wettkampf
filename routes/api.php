<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', 'UserController@AuthRouteAPI');

Route::get('/', 'ContentController@homeApi');
Route::get('/live/{page}', 'ContentController@liveApi');
Route::get('/list/{event_id}', 'ContentController@listApi');

// WebService for Input data
Route::post('/event','EventController@storeApi');
Route::post('/result','ResultController@storeApi');

<?php

use Illuminate\Http\Request;
use App\Draw;
use Illuminate\Support\Carbon;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pic', 'DrawController@get');
Route::get('/plate', 'DrawController@plate');

Route::middleware('auth')->post('/upload', 'DrawController@update');

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

Route::get('/', [ 'as' => 'home', 'uses' => 'TipController@pageHome']);
Route::post('/tip', [ 'as' => 'tip.share', 'uses' => 'TipController@store']);
Route::get('/tip/{tip}/report', [ 'as' => 'tip.report', 'uses' => 'TipController@report']);

Route::get('top', [ 'as' => 'top', 'uses' => 'TipController@pageTop']);

Route::get('about', [ 'as' => 'about', 'uses' => function() {
	return view('pages.about.index');
}]);

Auth::routes();

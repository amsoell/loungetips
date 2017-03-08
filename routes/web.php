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

Route::get('/', [ 'as' => 'home', 'uses' => function () {
    return view('pages.home.index');
}]);

Route::get('top', [ 'as' => 'top', 'uses' => function() {
	return 'top';
}]);

Route::get('about', [ 'as' => 'about', 'uses' => function() {
	return view('pages.about.index');
}]);

Auth::routes();

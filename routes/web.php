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

// 301 redirects for backwards compatability
Route::get('about.php', function() {
	return Redirect::to('/about', 301);
});

Route::get('top.php', function() {
	return Redirect::to('/top', 301);
});

// Redirect Category Links
Route::get('talk/forum{id}.html', function($id) {
	$category = \Riari\Forum\Models\Category::find($id);
	return Redirect::to(Forum::route('category.show', $category), 301);
});

// Redirect Forum Links
// Redirect Topic Links
// Redirect Post Links

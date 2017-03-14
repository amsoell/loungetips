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

Route::get('user/{user}', [ 'as' => 'user.profile', 'uses' => 'UserController@pageProfile']);

Auth::routes();
Route::get('logout', [ 'as' => 'logout', 'uses' => 'Auth\LoginController@logout' ]);

// 301 redirects for backwards compatability
Route::get('about.php', function() {
	return Redirect::to('/about', 301);
});

Route::get('top.php', function() {
	return Redirect::to('/top', 301);
});

// Redirect Forum Links
Route::get('talk/forum{category}.html', function(\Riari\Forum\Models\Category $category) {
	return Redirect::to(Forum::route('category.show', $category), 301);
});

// Redirect Topic Links
Route::get('talk/topic{thread}.html', function(\Riari\Forum\Models\Thread $thread) {
	return Redirect::to(Forum::route('thread.show', $thread), 301);
});

// Redirect Post Links
Route::get('talk/post{post}.html', function(\Riari\Forum\Models\Post $post) {
	return Redirect::to(Forum::route('post.show', $post), 301);
});

// Redirect User Profile Links
Route::get('talk/user{user}.html', function(App\User $user) {
	return Redirect::to(route('user.profile', $user), 301);
});
Route::get('talk/user/{user}', function(App\User $user) {
	return Redirect::to(route('user.profile', $user), 301);
});

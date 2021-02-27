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

Route::get('/','IntroductionsController@index');


// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login/guest','Auth\LoginController@guestLogin')->name('login.guest');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        Route::get('favorites','UsersController@favorites')->name('users.favorites');
    });
    Route::resource('users', 'UsersController', ['only' => ['index','edit','update','show']]);
    Route::resource('introductions', 'IntroductionsController', ['only' => ['create','store','destroy']]);
});

    Route::group(['prefix' => 'introductions/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
        Route::delete('destroy','CommentsController@destroy')->name('comments.destroy');
        Route::get('commenting','CommentsController@create')->name('commenting.create');
    });
    
    Route::group(['prefix' => 'comments/{id}'], function () {
        Route::post('comment','CommentsController@store')->name('comments.comment');
    });
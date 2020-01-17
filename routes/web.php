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

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@service');
Route::resource('posts','PostsController');
Route::resource('comments','CommentsController');
Route::resource('profile','ProfilesController');
//Route::post('/comments/{post_id}','CommentsController@storeWithId');
/*Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

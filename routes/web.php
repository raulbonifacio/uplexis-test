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

Route::get('/login', 'Auth\LoginController@showLoginForm');


Route::get('/', function () {
    return view('welcome');
}); 
Auth::routes();

Route::get('/articles', 'ArticleController@index')->name('articles');
Route::post('/articles', 'ArticleController@fetch')->name('fetch-articles');
Route::delete('/articles/{id}', 'ArticleController@remove')->name('remove-article');
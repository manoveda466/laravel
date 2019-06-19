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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/master', 'masterController@index')->name('master');
Route::post('/masterInsert', 'masterController@masterInsert')->name('masterInsert');
Route::get('/masterEdit/{student_id}', 'masterController@masterEdit')->name('masterEdit');
Route::get('/masterDelete/{student_id}', 'masterController@masterDelete')->name('masterDelete');
Route::get('/studentExport', 'masterController@studentExport')->name('studentExport');

Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');




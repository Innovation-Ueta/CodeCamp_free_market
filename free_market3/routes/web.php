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

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

// トップ画面
Route::get('/' ,'ItemController@index')->name('top');
// Route::get('/' ,'ItemController@showTopPage')->name('top');

// User

// プロフィール詳細
// Route::get('users/{user}', 'UserController@show')->name('users.show');
Route::get('users/{user}', 'UserController@show')->name('users.show');

// プロフィール編集
Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
Route::patch('profile/edit', 'UserController@update')->name('profile.update');

// プロフィール画像編集
Route::get('profile/edit_image', 'UserController@edit_image')->name('profile.edit_image');
Route::patch('profile/edit_image', 'UserController@update_image')->name('profile.update_image');


//Like
Route::resource('likes', 'LikeController')->only([
     'index', //'store', 'destroy'
]);

//
// Route::post('liekd_test', 'LikeController@isLike');

// Route::get('items/{item_id}/likes', 'LikeController@store');

// Route::get('likes/{like_id}/', 'LikeController@destroy');

Route::post('likes/', 'LikeController@isLike');
// Route::post('likes/{like_id}/likes', 'LikeController@isLike');

// Route::group(['middleware' => ['auth']], function () {
//      Route::post('likes/{like_id}/', 'LikeController@isLike');
// });


//Item
// 商品
Route::resource('items', 'ItemController');

// 商品画像変更
Route::get('items/{item}/edit_image', 'ItemController@edit_image')->name('items.edit_image');
Route::patch('items/{item}/update_image', 'ItemController@update_image')->name('items.update_image');

// 出品商品一覧
Route::get('users/{user}/exhibitions', 'ItemController@exhibitions')->name('users.exhibitions');
// Route::get('users/{user}/exhibitions', 'ItemController@exhibitions')->name('users.exhibitions');


//Oder
// 商品購入関連
Route::get('items/{item}/confirm', 'OrderController@confirm')->name('items.confirm');
Route::patch('items/{item}/confirm', 'OrderController@store_confirm')->name('items.store_confirm');
Route::get('items/{item}/finish', 'OrderController@finish')->name('items.finish');


Route::get('/home', 'HomeController@index')->name('home');

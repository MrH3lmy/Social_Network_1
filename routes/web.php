<?php

use Illuminate\Support\Facades\Route;
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
/**
 * Home
 */
Route::get('/', [
    'uses' => 'App\Http\Controllers\HomeController@index',
    'as' => 'home',

]);

Route::get('/alert',function(){
    return redirect() -> route('home')-> with ('info','You have signed up!'); 
});
/**
 * Authentication 
 */
Route:: get ('/signup',[
    'uses' => 'App\Http\Controllers\AuthController@getSignup',
    'as'=> 'auth.signup',
    //'middleware' => ['guest'],
]);


Route:: post ('/signup',[
    'uses' => 'App\Http\Controllers\AuthController@postSignup',
    //'middleware' => ['guest'],

   
]);
Route:: get ('/signin',[
    'uses' => 'App\Http\Controllers\AuthController@getSignin',
    'as'=> 'auth.signin',
   // 'middleware' => ['guest'],

]);


Route:: post ('/signin',[
    'uses' => 'App\Http\Controllers\AuthController@postSignin',
   // 'middleware' => ['guest'],

   
]);

Route:: get ('/signout',[
    'uses' => 'App\Http\Controllers\AuthController@getSignout',
    'as'=> 'auth.signout',
    //'middleware' => ['guest'],


]);


/**
 * 
 *  SEARCH 
 * 
 */

Route:: get ('/search',[
    'uses' => 'App\Http\Controllers\SearchController@getResults',
    'as'=> 'search.results',

]);



Route:: get ('/user/{username}',[
    'uses' => 'App\Http\Controllers\ProfileController@getProfile',
    'as'=> 'profile.index',

]);



Route:: get ('/profile/edit',[
    'uses' => 'App\Http\Controllers\ProfileController@getEdit',
    'as'=> 'profile.edit',

]);


Route:: post ('/profile/edit',[
    'uses' => 'App\Http\Controllers\ProfileController@postEdit',

]);


/**
 * 
 * Friends
 */

Route::get('/friends',[
    'uses' => 'App\Http\Controllers\FriendController@getIndex',
    'as'=> 'friend.index',
]);

Route::get('/friends/add/{username}',[
    'uses' => 'App\Http\Controllers\FriendController@getAdd',
    'as'=> 'friend.add',
]);

Route::get('/friends/accept/{username}',[
    'uses' => 'App\Http\Controllers\FriendController@getAccept',
    'as'=> 'friend.accept',
]);

/**statuses */


Route::post('/status',[
    'uses' => 'App\Http\Controllers\StatusController@postStatus',
    'as'=> 'status.post',
]);


Route::post('/status/{statusId}/reply',[
    'uses' => 'App\Http\Controllers\StatusController@postReply',
    'as'=> 'status.reply',
]);
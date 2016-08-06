<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');



Route::group(['middleware' => 'admin'], function(){

    Route::get      ('/admin/users'             , 'AdminController@users'                   );
    Route::get      ('/admin/users/create'      , 'AdminController@createUser'              );
    Route::post     ('/admin/users/storeuser'   , 'AdminController@storeUser'               );
    Route::get      ('/admin/users/edit/{id}'   , 'AdminController@editUser'                );
    Route::post     ('/admin/users/update/{id}' , 'AdminController@updateUser'              );
    Route::delete   ('/admin/users/destroy/{id}', 'AdminController@destroyUser'             );
    Route::get      ('admin/posts'              , 'AdminController@posts'                   );
    Route::get      ('admin/posts/create'       , 'AdminController@createPost'              );
    Route::post     ('admin/posts/store'        , 'AdminController@storePost'               );
    Route::get      ('admin/posts/edit/{id}'    , 'AdminController@editPost'                );
    Route::post     ('admin/posts/update/{id}'  , 'AdminController@updatePost'              );
    Route::delete   ('admin/posts/delete/{id}'  , 'AdminController@deletePost'              );
});

Route::get          ('/admin'                   , function(){ return view('admin.index'); } );



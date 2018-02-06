<?php

Route::get('/', function () {
    return view('welcome');
});

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  | client_check => from application only authorized client can access this API
  |              => to add multipal cleint add keys and secret in application table
 */
Route::get('user/email-verify', 'UserController@email_verify');
Route::group(['prefix' => 'api', 'middleware' => ['client_check']], function () {
    Route::post('user/register', 'UserController@register');
    Route::post('user/login', 'UserController@login');

    Route::group(['prefix' => '', 'middleware' => ['api_auth']], function () {
        Route::get('user/me', 'UserController@user_get');
    });
});




/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
 */
Route::get('admin', function() {
    return redirect('admin/login');
});
Route::get('admin/login', ['as' => 'admin_login', 'uses' => 'AdminController@login']);
Route::post('admin/login', ['uses' => 'AdminController@try_login']);
Route::get('admin/logout', function() {
    Session::put('admin', null);
    Session::flash('message', 'Logged out');
    return redirect()->route('admin_login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin_ui_auth'], function () {
    Route::get('home', ['as' => 'admin_home', 'uses' => 'AdminController@home']);
    Route::get('/change_password', ['as' => 'change_password', 'uses' => 'AdminController@change_password_get']);
    Route::post('/change_password', ['uses' => 'AdminController@change_password']);

    /*
      |--------------------------------------------------------------------------
      | sub-menu rendering management
      |--------------------------------------------------------------------------
      |
     */
    Route::get('user_management/create', 'AdminController@user_management_create');
    Route::get('user_management/list', 'AdminController@user_management_list');
    Route::get('user_management/edit', 'AdminController@user_management_edit');
});

/*
  |--------------------------------------------------------------------------
  | Admin API Routes
  |--------------------------------------------------------------------------
  |
 */
Route::group(['prefix' => 'api', 'middleware' => ['client_check']], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'admin_ui_auth'], function () {
        Route::post('users/create', 'UserController@admin_user_register');
        Route::post('users/list', 'UserController@admin_user_list');
        Route::post('users/status', 'UserController@admin_user_status');
        Route::post('users/delete', 'UserController@admin_user_delete');
        Route::post('users/get_user', 'UserController@admin_user_get');
        Route::post('users/edit', 'UserController@admin_user_edit');
    });
});


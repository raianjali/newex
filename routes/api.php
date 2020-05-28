<?php

Route::post('auth/login', ['uses' => 'AuthController@login', 'as' => 'login']);
Route::post('auth/registerStudent', ['uses' => 'AuthController@registerStudent', 'as' => 'registerStudent']);

Route::group(['middleware' => 'auth.role:4'], function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('me', 'AuthController@me');
    Route::post('user/{user_id}', 'AuthController@updateStudent');
    Route::delete('user/{user_id}', 'AuthController@destroy_user');
 
});
/*Route::get('users/superadmin', ['uses' => 'UsersController@superadminlogin', 'as' => 'users.superadmin']);
Route::get('users/admin', ['uses' => 'UsersController@adminlogin', 'as' => 'users.admin']);
Route::get('users/teacher', ['uses' => 'UsersController@teacherlogin', 'as' => 'users.teacher']);
Route::get('users/student', ['uses' => 'UsersController@studentlogin', 'as' => 'users.student']);*/

Route::group(['middleware' => ['api', 'jwt.verify'],], function ($router) {

    // Static Country
    Route::get('static/country', 'StaticDataController@index_country');
    
    // Static State
    Route::get('static/state', 'StaticDataController@index_state');

    // Static City
    Route::get('static/city', 'StaticDataController@index_city');

    // Role
    Route::get('static/role', 'StaticDataController@index_roles');

});
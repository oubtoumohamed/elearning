<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/user/'], function () {

        Route::get('list', 'UsersController@index')
            ->name('user')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'UsersController@create')
            ->name('user_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'UsersController@store')
            ->name('user_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'UsersController@destroy')
            ->name('user_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'UsersController@show')
            ->name('user_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'UsersController@edit')
            ->name('user_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'UsersController@update')
            ->name('user_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
    });
});
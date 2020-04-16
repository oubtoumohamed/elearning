<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/media/'], function () {

        Route::get('list', 'MediaController@index')
            ->name('media')
            ->middleware('Admin:ADMIN');

        Route::get('connector', 'MediaController@connector')
            ->name('media_connector')
            ->middleware('Admin:ADMIN');
            
        Route::post('connector', 'MediaController@connector2')
            ->name('media_connector2')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'MediaController@create')
            ->name('media_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'MediaController@store')
            ->name('media_store')
            ->middleware('Admin:ADMIN');

        Route::get('{id}/edit', 'MediaController@edit')
            ->name('media_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'MediaController@update')
            ->name('media_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});
<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/groupe/'], function () {

        Route::get('list', 'GroupeController@index')
            ->name('groupe')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'GroupeController@create')
            ->name('groupe_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'GroupeController@store')
            ->name('groupe_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'GroupeController@destroy')
            ->name('groupe_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'GroupeController@show')
            ->name('groupe_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'GroupeController@edit')
            ->name('groupe_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'GroupeController@update')
            ->name('groupe_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});
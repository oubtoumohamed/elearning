<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/filier/'], function () {

        Route::get('list', 'FilierController@index')
            ->name('filier')
            ->middleware('Admin:Filier');
        
        Route::get('create', 'FilierController@create')
            ->name('filier_create')
            ->middleware('Admin:Filier');
        
        Route::post('create', 'FilierController@store')
            ->name('filier_store')
            ->middleware('Admin:Filier');
        
        Route::get('{id}/delete', 'FilierController@destroy')
            ->name('filier_delete')
            ->middleware('Admin:Filier')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'FilierController@show')
            ->name('filier_show')
            ->middleware('Admin:Filier')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'FilierController@edit')
            ->name('filier_edit')
            ->middleware('Admin:Filier')
            ->where('id', '[0-9]+');

        Route::get('{id}', 'FilierController@edit')
            ->name('filier_show')
            ->middleware('Admin:Filier')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'FilierController@update')
            ->name('filier_update')
            ->middleware('Admin:Filier')
            ->where('id', '[0-9]+');
        
    });
});
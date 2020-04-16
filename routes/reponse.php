<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/reponse/'], function () {

        Route::get('list', 'ReponseController@index')
            ->name('reponse')
            ->middleware('Admin:Reponse');
        
        Route::get('create', 'ReponseController@create')
            ->name('reponse_create')
            ->middleware('Admin:Reponse');
        
        Route::post('create', 'ReponseController@store')
            ->name('reponse_store')
            ->middleware('Admin:Reponse');
        
        Route::get('{id}/delete', 'ReponseController@destroy')
            ->name('reponse_delete')
            ->middleware('Admin:Reponse')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'ReponseController@show')
            ->name('reponse_show')
            ->middleware('Admin:Reponse')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'ReponseController@edit')
            ->name('reponse_edit')
            ->middleware('Admin:Reponse')
            ->where('id', '[0-9]+');

        Route::get('{id}', 'ReponseController@edit')
            ->name('reponse_show')
            ->middleware('Admin:Reponse')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'ReponseController@update')
            ->name('reponse_update')
            ->middleware('Admin:Reponse')
            ->where('id', '[0-9]+');
        
    });
});
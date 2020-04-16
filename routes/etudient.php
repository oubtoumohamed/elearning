<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/etudient/'], function () {

        Route::get('list', 'EtudientController@index')
            ->name('etudient')
            ->middleware('Admin:Etudient');
        
        Route::get('create', 'EtudientController@create')
            ->name('etudient_create')
            ->middleware('Admin:Etudient');
        
        Route::post('create', 'EtudientController@store')
            ->name('etudient_store')
            ->middleware('Admin:Etudient');
        
        Route::get('{id}/delete', 'EtudientController@destroy')
            ->name('etudient_delete')
            ->middleware('Admin:Etudient')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'EtudientController@show')
            ->name('etudient_show')
            ->middleware('Admin:Etudient')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'EtudientController@edit')
            ->name('etudient_edit')
            ->middleware('Admin:Etudient')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'EtudientController@update')
            ->name('etudient_update')
            ->middleware('Admin:Etudient')
            ->where('id', '[0-9]+');

        Route::get('cours', 'EtudientController@list_cours')
            ->name('etudient_list_cours')
            ->middleware('Admin:ETUDIENT');

        Route::get('cours/{id}', 'EtudientController@show_cours')
            ->name('etudient_show_cours')
            ->middleware('Admin:ETUDIENT');
        
    });
});
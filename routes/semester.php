<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/semester/'], function () {

        Route::get('list', 'SemesterController@index')
            ->name('semester')
            ->middleware('Admin:Semester');
        
        Route::get('create', 'SemesterController@create')
            ->name('semester_create')
            ->middleware('Admin:Semester');
        
        Route::post('create', 'SemesterController@store')
            ->name('semester_store')
            ->middleware('Admin:Semester');
        
        Route::get('{id}/delete', 'SemesterController@destroy')
            ->name('semester_delete')
            ->middleware('Admin:Semester')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'SemesterController@show')
            ->name('semester_show')
            ->middleware('Admin:Semester')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'SemesterController@edit')
            ->name('semester_edit')
            ->middleware('Admin:Semester')
            ->where('id', '[0-9]+');

        Route::get('{id}', 'SemesterController@edit')
            ->name('semester_show')
            ->middleware('Admin:Semester')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'SemesterController@update')
            ->name('semester_update')
            ->middleware('Admin:Semester')
            ->where('id', '[0-9]+');
        
    });
});
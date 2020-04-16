<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/cours/'], function () {

        Route::get('list', 'CoursController@index')
            ->name('cours')
            ->middleware('Admin:PROF');
        
        Route::get('create', 'CoursController@create')
            ->name('cours_create')
            ->middleware('Admin:PROF');
        
        Route::post('create', 'CoursController@store')
            ->name('cours_store')
            ->middleware('Admin:PROF');
        
        Route::get('{id}/delete', 'CoursController@destroy')
            ->name('cours_delete')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'CoursController@show')
            ->name('cours_show')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'CoursController@edit')
            ->name('cours_edit')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');

        Route::get('{id}', 'CoursController@edit')
            ->name('cours_show')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'CoursController@update')
            ->name('cours_update')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/add-question', 'CoursController@add_question')
            ->name('cours_add_question')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');

        Route::get('question_unread', 'CoursController@question_unread')
            ->name('cours_question_unread')
            ->middleware('Admin:PROF');
        
        Route::get('question_make_readed', 'CoursController@question_make_readed')
            ->name('cours_question_make_readed')
            ->middleware('Admin:PROF');

        // Etudient
        
        Route::get('{id}/etudient/question', 'CoursController@add_question')
            ->name('etudient_cours_add_question')
            ->middleware('Admin:ETUDIENT')
            ->where('id', '[0-9]+');
    });
});
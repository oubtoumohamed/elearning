<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/question/'], function () {

        Route::get('list', 'QuestionController@index')
            ->name('question')
            ->middleware('Admin:Question');
        
        Route::get('create', 'QuestionController@create')
            ->name('question_create')
            ->middleware('Admin:Question');
        
        Route::post('create', 'QuestionController@store')
            ->name('question_store')
            ->middleware('Admin:Question');
        
        Route::get('{id}/delete', 'QuestionController@destroy')
            ->name('question_delete')
            ->middleware('Admin:Question')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'QuestionController@show')
            ->name('question_show')
            ->middleware('Admin:Question')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'QuestionController@edit')
            ->name('question_edit')
            ->middleware('Admin:Question')
            ->where('id', '[0-9]+');

        Route::get('{id}', 'QuestionController@edit')
            ->name('question_show')
            ->middleware('Admin:Question')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'QuestionController@update')
            ->name('question_update')
            ->middleware('Admin:Question')
            ->where('id', '[0-9]+');
        
    });
});
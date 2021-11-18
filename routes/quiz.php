<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/quiz/'], function () {

        Route::get('list', 'QuizController@index')
            ->name('quiz')
            ->middleware('Admin:PROF');
        
        Route::get('create', 'QuizController@create')
            ->name('quiz_create')
            ->middleware('Admin:PROF');
        
        Route::post('create', 'QuizController@store')
            ->name('quiz_store')
            ->middleware('Admin:PROF');
        
        Route::get('{id}/delete', 'QuizController@destroy')
            ->name('quiz_delete')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'QuizController@show')
            ->name('quiz_show')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'QuizController@edit')
            ->name('quiz_edit')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');

        Route::get('{id}', 'QuizController@edit')
            ->name('quiz_show')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'QuizController@update')
            ->name('quiz_update')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/add-question', 'QuizController@add_question')
            ->name('quiz_add_question')
            ->middleware('Admin:PROF')
            ->where('id', '[0-9]+');

        Route::get('question_unread', 'QuizController@question_unread')
            ->name('quiz_question_unread')
            ->middleware('Admin:PROF');
        
        Route::get('question_make_readed', 'QuizController@question_make_readed')
            ->name('quiz_question_make_readed')
            ->middleware('Admin:PROF');

        // Etudient
        
        Route::get('{id}/etudient/question', 'QuizController@add_question')
            ->name('etudient_quiz_add_question')
            ->middleware('Admin:ETUDIENT')
            ->where('id', '[0-9]+');
    });
});
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




// ANDROID APP API 
Route::group(['middleware' => 'web'], function () {
    // Etudient
    Route::group(['prefix' => '/api/etudient/'], function () {
        Route::get('login', 'ApiController@EtudientLogin')->name('etudient_login');
    });

    
    // Prof
    Route::group(['prefix' => '/api/prof/'], function () {
        Route::get('login', 'ApiController@ProfLogin')->name('prof_login');
    });

});*/

Route::group(['prefix' => 'etudient'], function () {

    //Route::post('signup', 'ApiEtudientController@signup');
    Route::post('login', 'ApiEtudientController@login');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('modules_semesters', 'ApiEtudientController@modules_semesters');
        Route::get('course', 'ApiEtudientController@course');
        Route::get('course/messages', 'ApiEtudientController@messages');
        Route::get('course/messages/send', 'ApiEtudientController@send_message');
        Route::get('courses', 'ApiEtudientController@courses');
        Route::get('filiere', 'ApiEtudientController@filiere');
        Route::get('modules', 'ApiEtudientController@modules');
        Route::get('details', 'ApiEtudientController@details');
        Route::get('logout', 'ApiEtudientController@logout');
    });
});

Route::group(['prefix' => 'prof'], function () {

    //Route::post('signup', 'ApiEtudientController@signup');
    Route::post('login', 'ApiProfController@login');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('Cours', 'ApiProfController@Cours');
        Route::get('Modules', 'ApiProfController@Modules');
        Route::get('AllFilieres', 'ApiProfController@AllFilieres');
        Route::get('Filier_Modules', 'ApiProfController@Filier_Modules');
        Route::get('Question_Rep', 'ApiProfController@Question_Rep');
        //creation 
        Route::post('Newcourse', 'ApiProfController@Newcourse');
        Route::post('NewQuestion', 'ApiProfController@NewQuestion');
        Route::post('NewReponse', 'ApiProfController@NewReponse');
        //update 
        Route::put('UpdateCour/{id}', 'ApiProfController@UpdateCour');

        Route::get('details', 'ApiProfController@details');
        Route::get('logout', 'ApiProfController@logout');
    });
});
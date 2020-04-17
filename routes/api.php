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

    Route::post('signup', 'ApiEtudientController@signup');
    Route::post('login', 'ApiEtudientController@login');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'ApiEtudientController@logout');
        Route::get('details', 'ApiEtudientController@details');
    });
});
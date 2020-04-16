<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index')->name('frontend_home');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('home', 'HomeController@admin')->name('home');
        Route::get('admin', 'HomeController@admin')->name('admin');
    });
});

Route::get('lang/{lang}', function($lang){
	if (array_key_exists($lang, Config::get('languages'))) {
		Session::put('applocale', $lang);
	}
	return Redirect::back();
})->name('setlange');

include 'user.php';
include 'media.php';
include 'groupe.php';
include 'prof.php';
include 'etudient.php';
include 'semester.php';
include 'filier.php';
include 'module.php';
include 'question.php';
include 'reponse.php';
include 'cours.php';




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

});
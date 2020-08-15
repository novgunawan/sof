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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('questions', 'QuestionController');
	Route::resource('answers', 'AnswerController');
	Route::resource('comments', 'CommentController');

	Route::post('/questionscomments','QuestioncommentController@store');
	Route::post('/answerscomments','AnswercommentController@store');

	Route::get('/detail', function() {
		return view('question.detail');
	});
	Route::get('/profile', function() {
		return view('profile');
	});
	Route::post('/vote', 'QuestionController@questionVote')->name('vote');
});

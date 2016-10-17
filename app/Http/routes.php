<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// API endpoints
Route::group(array('prefix' => 'api'), function () {


    Route::get('/', function () {
        return array("welcome to the Time Manager API");
    });

    // authentication endpoints
    Route::post('/users/signin', array('uses' => 'UserController@signIn'));
    Route::post('/users/signup', array('uses' => 'UserController@signUp'));

    // Private endpoints, require authentication
    Route::group(array('middleware' => ['jwt.auth']), function () {

        // TODO User endpoints
        Route::get('/me', 'UserController@me');

        // worksheets REST endpoints
        Route::get('user/{id}/worksheets', 'WorksheetController@userWorksheets');
        Route::post('worksheets', 'WorksheetController@storeWorksheet');
        Route::get('worksheets/{id}', 'WorksheetController@getWorksheet');
        Route::put('worksheets/{id}', 'WorksheetController@storeWorksheet');
        Route::delete('worksheets/{id}', 'WorksheetController@deleteWorksheet');

        // notes REST endpoints
        Route::get('worksheets/{id}/notes', 'NoteController@worksheetNotes');
        Route::post('notes', 'NoteController@storeNote');
        Route::get('notes/{id}', 'NoteController@getNote');
        Route::put('notes/{id}', 'NoteController@updateNote');
        Route::delete('notes/{id}', 'NoteController@deleteNote');

    });
});

// Angular routes
Route::any('{path?}', 'ViewController@home')->where("path", "^(?!api/).+");

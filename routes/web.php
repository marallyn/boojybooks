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

Route::get('/readme', function () {
    return view('README');
})->name('readme');


// auth routes, but let's not mess with password resets
Auth::routes(['reset' => false]);


// book routes
Route::get('/book/{id}', 'BookController@show')->name('book.show');


// list routes
Route::delete('/list', 'ListController@remove')->name('list.remove');

Route::get('/list', 'ListController@index')->name('list');
Route::get('/list/{id}/down', 'ListController@moveDown')->name('list.move.down');
Route::get('/list/{id}/up', 'ListController@moveUp')->name('list.move.up');

Route::post('/list/add', 'ListController@add')->name('list.add');


// search routes
Route::get('/search', 'SearchController@index')->name('search');
Route::get('/search/{isbn}', 'SearchController@isbn')->name('search.isbn');

Route::post('/search', 'SearchController@search')->name('search.do');

Route::get('/test', function () {
    return "Write a test in web.php";
});

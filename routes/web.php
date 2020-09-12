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

Route::get('/books', 'BookController@index');
Route::get('/books/new', 'BookController@create');
Route::post('/books', 'BookController@store');

Route::get('/categories/new', 'CategoryController@create');
Route::post('/categories', 'CategoryController@store');

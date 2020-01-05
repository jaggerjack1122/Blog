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

Route::any('/', 'BlogController@ShowHome')->name('/');	

Route::get('/category', 'BlogController@ShowCategory')->name('/category');	
Route::post('/addCategory', ['as' => '/addCategory', 'uses' => 'BlogController@AddCategory']);
Route::get('/deleteCategoryByID/{id}',['as' => 'deleteCategoryByID/', 'uses' => 'BlogController@deleteCategoryByID']);	

Route::get('/article', 'BlogController@ShowArticle')->name('/article');	
Route::post('/addArticle', ['as' => '/addArticle', 'uses' => 'BlogController@addArticle']);
Route::get('/getUpdateArticleByID/{id}', ['as' => 'getUpdateArticleByID/', 'uses' => 'BlogController@getUpdateArticleByID']);
Route::post('/postUpdateArticleByID/{id}',['as' => 'postUpdateArticleByID/', 'uses' => 'BlogController@postUpdateArticleByID']);	
Route::get('/deleteArticleByID/{id}',['as' => 'deleteArticleByID/', 'uses' => 'BlogController@deleteArticleByID']);	


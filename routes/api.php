<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function(){

    Route::get('/', 'UserController@index');
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');

    Route::prefix( 'me')->group(function (){
        Route::get('/', 'MeController@me');

        //atualizar dados do user
        Route::put('/', 'MeController@update');
    });

    Route::prefix( 'posts')->group(function (){

        Route::get('/public', 'PostController@indexPublic');
        Route::get('/', 'PostController@index');

        Route::get('/{post}', 'PostController@show');
        Route::get('/{post}/public', 'PostController@showPublic');

        Route::post('/', 'PostController@store');
        Route::put('/{post}', 'PostController@update');
        Route::delete('/{post}', 'PostController@destroy');
        
        //add comentário no post
        Route::post('/{post}/comments', 'PostController@addComment');        
       
    });

    Route::prefix('post-comments')->group(function(){

        Route::get('/{postComment}','PostCommentController@allCommentsByPost');   
        Route::get('/{postComment}/public','PostCommentController@allCommentsByPostPublic');  

        Route::get('/{postComment}/show','PostCommentController@show');
        Route::get('/','PostCommentController@allCommentsByUser');     
        Route::put('{postComment}', 'PostCommentController@update');
        Route::delete('{postComment}', 'PostCommentController@destroy');
    });
});







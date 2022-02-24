<?php

use App\Http\Controllers\MovieController;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(
    ['middleware' => 'auth'], 
    function () use ($router): void {
        $router->get('/movies', '\App\Http\Controllers\MovieController@get');
        $router->get('/movies/{movieId}', '\App\Http\Controllers\MovieController@show');
        $router->post('/movies', '\App\Http\Controllers\MovieController@create');
        $router->put('/movies/{movieId}', '\App\Http\Controllers\MovieController@update');
        $router->delete('/movies/{movieId}', '\App\Http\Controllers\MovieController@destroy');
    }
);

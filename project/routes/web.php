<?php

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

use App\Models\User;
use Laravel\Lumen\Http\Request;

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users','UserController@index');
    $router->post('/users/register','UserController@create');
    $router->post('/users/login','UserController@login');
    $router->put('/users/{id}','UserController@update');
    $router->delete('/users/{id}','UserController@delete');
});



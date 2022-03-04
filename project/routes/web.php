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
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->group(['middleware' => 'jwt'], function () use ($router) {
            $router->get('/',['middleware'=> 'admin', 'uses'=> 'UserController@index']);
            $router->post('logout','UserController@logout');
            $router->put('{id}','UserController@update');
            $router->delete('{id}','UserController@delete');
        });
        $router->post('register','UserController@create');
        $router->post('login','UserController@login');
    });
    $router->group(['prefix' => 'courses'], function () use ($router) {
        $router->get('/','CourseController@index');
        $router->post('/',['middleware'=>['jwt','auth'], 'uses'=>'CourseController@create']);
    });
    $router->post('course_users',['middleware'=>'jwt','uses'=>'CourseUserController@add']);
    $router->put('course_lesson_users/{id}','LessonUserController@update');
    $router->get('course_lessons','CourseLessonController@index');
});




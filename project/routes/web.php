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
            $router->get('/', ['middleware'=> 'admin','uses'=> 'UserController@index']);
            $router->post('logout','UserController@logout');
            $router->put('{id}',['middleware'=>'owner','uses'=>'UserController@update']);
            $router->delete('{id}',['middleware'=>'owner','uses'=>'UserController@delete']);
        });

        $router->post('register','UserController@create');
        $router->post('login','UserController@login');
    });
    $router->group(['prefix' => 'courses'], function () use ($router) {
        $router->get('/','CourseController@index');
        $router->post('/',['middleware'=>['jwt','admin'], 'uses'=>'CourseController@create']);
    });
    $router->post('course_users',['middleware'=>'jwt','uses'=>'CourseUserController@add']);
    $router->get('course_lessons','CourseLessonController@index');
    $router->put('course_lesson_users/{id}',['middleware'=>'jwt','uses'=>'LessonUserController@update']);
});



<?php

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

/** @var Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get( '/groups' , 'GroupsController@index' ) ;
$router->get( '/people' , 'PeopleController@index' ) ;

$router->get( '/groups/{id}' , 'GroupsController@show' ) ;
$router->get( '/people/{id}' , 'PeopleController@show' ) ;

$router->put( '/groups/{id}' , 'GroupsController@update' ) ;
$router->put( '/people/{id}' , 'PeopleController@update' ) ;

$router->patch( '/groups/{id}' , 'GroupsController@update' ) ;
$router->patch( '/people/{id}' , 'PeopleController@update' ) ;

$router->post( '/groups/{id}' , 'GroupsController@store' ) ;
$router->post( '/people/{id}' , 'PeopleController@store' ) ;
$router->post( '/register' , 'RegistrationController@store' ) ;

$router->delete( '/groups/{id}' , 'GroupsController@remove' ) ;
$router->delete( '/people/{id}' , 'PeopleController@remove' ) ;


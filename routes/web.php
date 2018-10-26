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
$router->get( '/groups/{id}' , 'GroupsController@show' ) ;
$router->get( '/groups/{id}/people' , 'GroupsController@people' ) ;
$router->get( '/people' , 'PeopleController@index' ) ;
$router->get( '/person/{id}' , 'PeopleController@show' ) ;
$router->get( '/person/{id}/groups' , 'PeopleController@groups' ) ;
$router->get( '/register/{id}' , 'RegistrationController@show' ) ;
$router->get( '/registrations' , 'RegistrationController@index' ) ;

$router->put( '/groups/{id}' , 'GroupsController@update' ) ;
$router->put( '/person/{id}' , 'PeopleController@update' ) ;
$router->put( '/register/{id}' , 'RegistrationController@update' ) ;

$router->patch( '/groups/{id}' , 'GroupsController@update' ) ;
$router->patch( '/v/{id}' , 'PeopleController@update' ) ;
$router->patch( '/register/{id}' , 'RegistrationController@update' ) ;

$router->post( '/groups' , 'GroupsController@store' ) ;
$router->post( '/people' , 'PeopleController@store' ) ;
$router->post( '/register' , 'RegistrationController@store' ) ;

$router->delete( '/groups/{id}' , 'GroupsController@remove' ) ;
$router->delete( '/person/{id}' , 'PeopleController@remove' ) ;
$router->delete( '/register/{id}' , 'RegistrationController@remove' ) ;

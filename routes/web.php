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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Locations
$router->group(['prefix' => 'api/'], function () use($router){
    $router->get('locations', ['as' => 'locationList', 'uses' => "LocationController@index"]);
    $router->post('locations', ['as' => 'locationCreate', 'uses' => "LocationController@create"]);
    $router->get('locations/{id}', ['as' => 'locationShow', 'uses' => "LocationController@show"]);
    $router->put('locations/{id}', ['as' => 'locationUpdate', 'uses' => "LocationController@update"]);
    $router->delete('locations/{id}', ['as' => 'locationDelete', 'uses' => "LocationController@delete"]);
});


// Places
$router->group(['prefix' => 'api/'], function () use($router){
    $router->get('/locations/{id}/places', ['as' => 'placeList', 'uses' => "PlaceController@show"]);
    $router->post('locations/{id}/places', ['as' => 'placeCreate', 'uses' => "PlaceController@create"]);
    $router->put('places/{id}', ['as' => 'placeUpdate', 'uses' => "PlaceController@update"]);
    $router->delete('places/{id}', ['as' => 'placeDelete', 'uses' => "PlaceController@delete"]);
});



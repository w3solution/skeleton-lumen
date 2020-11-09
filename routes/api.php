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

$router->get('health-check', function () use ($router) {
    
    $version = $router->app->version();
    $status = [
        'code' => 200,
        'description' => 'application is running',
        'version' => $version
    ];

    return $status;
});

// auth & register
$router->post('login','UsersController@authenticate');
$router->post('register','UsersController@register');

// group routes
$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {

    // users
    $router->get('users', 'UsersController@get');

    // localizations
    $router->post('localization','LocalizationsController@store');
    $router->get('localization', 'LocalizationsController@index');
    $router->get('localization/{id}/', 'LocalizationsController@show');
    $router->put('localization/{id}/', 'LocalizationsController@update');

    // give my place
    $router->get('place', 'GeolocationsController@getAddressByLatLong');
        
});
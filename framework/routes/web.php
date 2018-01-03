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

$router->get('/users/{username}', ['as' => 'fetchUser', 'uses' => 'UsersController@fetchUser']);
$router->put('/users', ['as' => 'createUser', 'uses' => 'UsersController@createUser']);
$router->post('/users/{username}', ['as' => 'saveUser', 'uses' => 'UsersController@saveUser']);
$router->post('/users/login', ['as' => 'login', 'uses' => 'UsersController@login']);
$router->post('/users/passwordReset', ['as' => 'login', 'uses' => 'UsersController@resetPassword']);


$router->get('/settings/{userId}[/{settingName}]', ['as' => 'fetchSetting', 'uses' => 'SettingsController@fetchSetting']);
$router->post('/settings/{userId}/settingName', ['as' => 'saveSetting', 'uses' => 'SettingsController@saveSetting']);

$router->get('/hops/{hopId}/{userId}', ['as' => 'fetchHop', 'uses' => 'HopsController@fetchHops']);
$router->get('/hops/{search}', ['as' => 'searchHops', 'uses' => 'HopsController@searchHops']);
$router->post('/hops/{hopId}/{userId}', ['as' => 'saveHop', 'uses' => 'HopsController@saveHop']);

$router->get('/grains/{grainId}', ['as' => 'fetcGrain', 'uses' => 'GrainsController@fetchGrain']);
$router->get('/grains/{search}', ['as' => 'searchGrains', 'uses' => 'GrainsController@searchGrains']);

$router->post('/calculations/IBU', ['as' => 'doIBUCalculations', 'uses' => 'CalculationsController@IbuCalcs']);
$router->post('/calculations/IBU/fill', ['as' => 'doIBUFillCalculations', 'uses' => 'CalculationsController@FillIbuCalcs']);
$router->post('/calculations/gravity', ['as' => 'doGravityCalculations', 'uses' => 'CalculationsController@GravityCalcs']);
$router->post('/calculations/gravity/fill', ['as' => 'doGravityFillCalculations', 'uses' => 'CalculationsController@FillGravityCalcs']);



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$router->group(['namespace' => '\App\Http\Controllers', 'prefix' => 'v1'], function () use ($router) {
    $router->get('breeds', 'CatAndDogController@breeds');
    $router->get('breeds/{breed}', 'CatAndDogController@images');
    $router->get('list', 'CatAndDogController@list');
    $router->get('image/{image_id}', 'CatAndDogController@getImageByID');
});

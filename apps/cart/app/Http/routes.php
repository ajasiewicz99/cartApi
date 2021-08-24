<?php namespace App\Http;

use App\Http\Controllers\CartController;
use App\Http\Controllers\HealthCheckController;
use Laravel\Lumen\Routing\Router;

/** @var \Laravel\Lumen\Routing\Router $router */


$router->group([
    'prefix' => 'api/v1',
], function (Router $router): void {
    $router->post('/add-to-cart/{id}', [
        'uses' => CartController::class . '@add',
    ]);

    $router->get('/show-cart', [
        'uses' => CartController::class . '@get',
        'middleware' => ['sessionChecker']
    ]);

    $router->delete('/remove/{id}', [
        'uses' => CartController::class . '@remove',
        'middleware' => ['sessionChecker']
    ]);
});
$router->get('/_health', HealthCheckController::class . '@health');
$router->get('/_info', HealthCheckController::class . '@info');

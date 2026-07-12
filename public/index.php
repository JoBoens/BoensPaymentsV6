<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';

use App\Core\Router;
use App\Controllers\DashboardController;
use App\Controllers\BetalingenController;

$router = new Router();

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

$router->get('/', [
    DashboardController::class,
    'index'
]);

/*
|--------------------------------------------------------------------------
| Betalingen
|--------------------------------------------------------------------------
*/

$router->get('/betalingen', [
    BetalingenController::class,
    'index'
]);

$router->get('/betalingen/create', [
    BetalingenController::class,
    'create'
]);

$router->post('/betalingen/store', [
    BetalingenController::class,
    'store'
]);

$router->get('/betalingen/edit/{id}', [
    BetalingenController::class,
    'edit'
]);

$router->post('/betalingen/update/{id}', [
    BetalingenController::class,
    'update'
]);

$router->get('/betalingen/delete/{id}', [
    BetalingenController::class,
    'delete'
]);

$router->dispatch();
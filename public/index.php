<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : public/index.php
 * Versie  : 6.3.1
 * Doel    : Front Controller
 * ------------------------------------------------------------
 */

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

$router->get('/', [DashboardController::class, 'index']);
$router->get('/dashboard', [DashboardController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Betalingen
|--------------------------------------------------------------------------
*/

$router->get('/betalingen', [BetalingenController::class, 'index']);

$router->get('/betalingen/create', [BetalingenController::class, 'create']);
$router->post('/betalingen', [BetalingenController::class, 'store']);

$router->get('/betalingen/edit', function () {

    $controller = new BetalingenController();

    $controller->edit((int)($_GET['id'] ?? 0));

});

$router->post('/betalingen/update', function () {

    $controller = new BetalingenController();

    $controller->update((int)($_POST['id'] ?? 0));

});

$router->get('/betalingen/delete', function () {

    $controller = new BetalingenController();

    $controller->delete((int)($_GET['id'] ?? 0));

});

/*
|--------------------------------------------------------------------------
| Router starten
|--------------------------------------------------------------------------
*/

$router->dispatch();
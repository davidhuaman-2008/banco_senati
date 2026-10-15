<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Router;
use App\Core\Session;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\ClienteController;
use App\Controllers\DepositoController;
use App\Controllers\RetiroController;
use App\Controllers\PagoServicioController;
use App\Controllers\UsuarioController;
use App\Controllers\ReporteController;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

Session::start();

$publicRoutes = ['/login'];
$currentUri   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!Session::has('user') && !in_array($currentUri, $publicRoutes)) {
    header('Location: /login');
    exit;
}

$router = new Router();

$router->get('/login',   [AuthController::class, 'showLogin']);
$router->post('/login',  [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

$router->get('/',          [DashboardController::class, 'index']);
$router->get('/dashboard', [DashboardController::class, 'index']);

$router->get('/clientes',              [ClienteController::class, 'index']);
$router->post('/clientes',             [ClienteController::class, 'store']);
$router->post('/clientes/{id}/update', [ClienteController::class, 'update']);
$router->post('/clientes/{id}/delete', [ClienteController::class, 'destroy']);

$router->get('/depositos',              [DepositoController::class, 'index']);
$router->post('/depositos',             [DepositoController::class, 'store']);
$router->post('/depositos/{id}/delete', [DepositoController::class, 'destroy']);

$router->get('/retiros',              [RetiroController::class, 'index']);
$router->post('/retiros',             [RetiroController::class, 'store']);
$router->post('/retiros/{id}/delete', [RetiroController::class, 'destroy']);

$router->get('/pagos',              [PagoServicioController::class, 'index']);
$router->post('/pagos',             [PagoServicioController::class, 'store']);
$router->post('/pagos/{id}/delete', [PagoServicioController::class, 'destroy']);

$router->get('/usuarios',              [UsuarioController::class, 'index']);
$router->post('/usuarios',             [UsuarioController::class, 'store']);
$router->post('/usuarios/{id}/delete', [UsuarioController::class, 'destroy']);

$router->get('/reportes/clientes',  [ReporteController::class, 'clientesPdf']);
$router->get('/reportes/depositos', [ReporteController::class, 'depositosPdf']);
$router->get('/reportes/retiros',   [ReporteController::class, 'retirosPdf']);
$router->get('/reportes/pagos',     [ReporteController::class, 'pagosPdf']);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\actividadesController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

//rutas de actividades
$router->get('/actividades', [actividadesController::class, 'renderizarPagina']);
$router->post('/actividades/guardarAPI', [actividadesController::class, 'guardarAPI']);
$router->get('/actividades/buscarAPI', [actividadesController::class, 'buscarAPI']);
$router->post('/actividades/modificarAPI', [actividadesController::class, 'modificarAPI']);
$router->get('/actividades/eliminar', [actividadesController::class, 'EliminarAPI']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

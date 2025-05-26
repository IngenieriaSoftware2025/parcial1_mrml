<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\actividadesController;
use Controllers\registroController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

//rutas de actividades
$router->get('/actividades', [actividadesController::class, 'renderizarPagina']);
$router->post('/actividades/guardarAPI', [actividadesController::class, 'guardarAPI']);
$router->get('/actividades/buscarAPI', [actividadesController::class, 'buscarAPI']);
$router->post('/actividades/modificarAPI', [actividadesController::class, 'modificarAPI']);
$router->get('/actividades/eliminar', [actividadesController::class, 'EliminarAPI']);


//Rutas de Registro
$router->get('/registro', [registroController::class, 'renderizarPagina']);
$router->post('/registro/guardarAPI', [registroController::class, 'guardarAPI']);
$router->get('/registro/buscarAPI', [registroController::class, 'buscarAPI']);
$router->post('/registro/modificarAPI', [registroController::class, 'modificarAPI']);
$router->get('/registro/eliminar', [registroController::class, 'EliminarAPI']);
$router->get('/registro/obtenerActividadesAPI', [registroController::class, 'obtenerActividadesAPI']);
$router->get('/registro/obtenerTodasActividadesAPI', [registroController::class, 'obtenerTodasActividadesAPI']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();


//mostrar listado de assitencias con filtros por actividad y fecha

//mostrar si fue puntual o llego tarde columna con texto puntuial o transliterator_get_error_code

//posibilidad de elimnar asistencia registreada

//confirmaciones de acciones con sweetalert2

//Que cuando se elimine no se elimine de la bd, solo lo cambie de situacion a 0
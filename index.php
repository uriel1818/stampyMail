<?php


/**
 * Importo lo necesario para arrancar la app.
 */
require_once 'config.php';
require_once MIDDLEWARES . 'router.php';


use controllers\Router;

//muestro el inicio de la aplicacion en el log.
error_log('<--- INICIO --->');

/**
 * Genero las rutas y ejecuto la app desde el router.
 */
$router = new Router;
$router->route();

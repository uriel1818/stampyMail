<?php
//configuraciones propias de php.ini
date_default_timezone_set('America/Argentina/Cordoba');
error_reporting(E_ALL);
ini_set('log_errors', TRUE);
ini_set('error_log', 'D:/Servidor/StampyMail/logs.log');
ini_set('session.cookie_path', 'D:/Servidor/StampyMail/');

//url de la app
define('URL', 'http://localhost.StampyMail/');
define('APP_NAME', 'StampyMail');

//rutas o boilerplate de la app
define('CONTROLLERS', './controllers/');
define('HELPERS', './helpers/');
define('VIEWS', './views/');
define('JAVASCRIPT', VIEWS . 'javascript/');
define('CSS', VIEWS . 'css/');
define('MODELS', './models/');
define('LAYOUTS', VIEWS . 'layouts/');


//variables default
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_ACTION', 'index');
define('DEFAULT_LAYOUT', 'default');
define('DEFAULT_VIEW', 'index');
define('DEFAULT_MODEL', 'model');

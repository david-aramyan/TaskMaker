<?php
session_start();

define('ROOT', dirname(__DIR__));
define('APP',$_SERVER['DOCUMENT_ROOT']);

spl_autoload_register(function($class) {

    $file = APP.'/core/'.str_replace('\\', '/', lcfirst($class)).'.php';
    if (is_file($file)) {
        require_once $file;
    }
});
$query = substr($_SERVER['REQUEST_URI'] , 1);
$route = Router::getRoute($query);

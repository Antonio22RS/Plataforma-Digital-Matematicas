<?php
// Front controller minimum (index.php)
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Controller/Router.php';
session_start();
$route = $_GET['route'] ?? 'auth/login';
list($controllerName, $actionName) = array_pad(explode('/', $route), 2, 'index');
$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = __DIR__ . '/Controller/' . ucfirst($controllerName) . 'Controller.php';
if (!preg_match('/^[a-zA-Z0-9_]+$/', $controllerName) || !preg_match('/^[a-zA-Z0-9_]+$/', $actionName)) {
    header("HTTP/1.0 400 Bad Request");
    echo "Bad request";
    exit;
}
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerClass)) {
        $ctrl = new $controllerClass();
        if (method_exists($ctrl, $actionName)) {
            $ctrl->{$actionName}();
            exit;
        }
    }
}
header("HTTP/1.0 404 Not Found");
echo "404 - Página no encontrada";
?>
<?php

use App\Controller\BaseController;

require_once __DIR__ . '/vendor/autoload.php';

if ($_GET) {
    $controller = $_GET['controller'];
    $metodo = $_GET['metodo'];

    $objClass = 'App\\Controller\\' . $controller;

    if (class_exists($objClass) && method_exists($objClass, $metodo)) {
        $obj = new $objClass();
        $ref = new ReflectionMethod($objClass, $metodo);
        if ($ref->getNumberOfParameters() > 0) {
            $obj->$metodo($_POST);
        } else {
            $obj->$metodo();
        }
    } else {
        // Pode colocar um fallback ou mensagem de erro
        echo "Controller ou método não encontrado.";
    }
} else {
    $inicio = new BaseController();
    $inicio->index();
}

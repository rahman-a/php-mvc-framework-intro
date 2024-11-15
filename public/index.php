<?php

use Core\Router;

const BASE_PATH = __DIR__ . "/../";
require BASE_PATH . "vendor/autoload.php";
require BASE_PATH . "src/Core/functions.php";


$router = new Router();

require base_path("src/routes.php");

// echo "<pre/>";
// dd($router->getRoutes());
// echo "</pre>";
try {
    $router->route();
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}

<?php

use Core\Router;

const BASE_PATH = __DIR__ . "/../";
require BASE_PATH . "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();
require BASE_PATH . "src/Core/functions.php";

$config = require(base_path("src/config.php"));

$router = new Router();

require base_path("src/routes.php");

// dd($router->getRoutes());
try {
    $router->route();
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}

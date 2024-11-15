<?php

$router->get('/', "index.php");
$router->get('/users', "users/index.php")->only("auth");
$router->get('/users/create', "users/create.php")->only("active");

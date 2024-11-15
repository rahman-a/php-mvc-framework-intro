<?php

use Core\Response;

function dd($data, $label = null)
{
    echo "<pre>";
    $label ? var_dump("{$label}: " . $data) : var_dump($data);
    echo "</pre>";
    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function redirect($path, $default = null)
{
    $default ? header("Location: $default") : header("Location: $path");
}


function console_log($object = null, $label = null)
{
    $message = json_encode($object, JSON_PRETTY_PRINT);
    $label = "Debug" . ($label ? " ($label): " : ': ');
    echo "<script>console.log(\"$label\", $message);</script>";
}


function views($path, $data = [])
{
    extract($data);
    require base_path("src/Http/views/" . $path);
}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);
    require BASE_PATH . "src/Http/views/{$code}.php";
    die();
}

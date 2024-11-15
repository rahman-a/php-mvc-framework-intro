<?php


function dd($data, $label = null)
{
    $label ? var_dump("{$label}: " . $data) : var_dump($data);
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

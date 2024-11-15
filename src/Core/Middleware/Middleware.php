<?php

namespace Core;

use Core\Middleware\Authenticated;
use Core\Middleware\Guest;
use Exception;

class Middleware
{

    public const MAP = [
        "auth" => Authenticated::class,
        "guest" => Guest::class
    ];

    public static function resolve($key)

    {
        if (!$key) return;

        if (!array_key_exists($key, self::MAP)) {
            throw new Exception('No middleware matched this request');
        };

        $middleware = self::MAP[$key];

        if (!$middleware) {
            throw new Exception('No middleware matched this request');
        }

        (new $middleware)->handle();
    }
}
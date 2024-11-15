<?php


namespace Core;

class Response
{
    const OK = 200;
    const CREATED = 201;
    const NO_CONTENT = 204;

    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
    const FORBIDDEN = 403;
    const TOO_MANY_REQUESTS = 429;

    const SERVER_ERROR = 500;
}

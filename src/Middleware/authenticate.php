<?php

namespace src\Middleware;

use App\Exception\Auth;
use Firebase\JWT\JWT;

class authenticate
{
    protected function checkToken(string $token): object
    {
        try {
            return JWT::decode($token, $_SERVER['SECRET_KEY'], ['HS256']);
        } catch (\UnexpectedValueException $exception) {
            throw new Auth('Forbidden: you are not authorized.', 403);
        }
    }
}
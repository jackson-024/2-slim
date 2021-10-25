<?php

$ba = function ($request, $response, $next) {
    $response->getBody()->write("Before");
    $response = $next($request, $response);
    $response->getBody()->write('After');

    return $response;
};
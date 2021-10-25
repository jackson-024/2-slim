<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\Middleware;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/controller/mainController.php';
require __DIR__ . '/../src/Middleware/beforeAfter.php';
// require __DIR__ . '/../src/Middleware/AuthMiddleware.php';
require __DIR__ . '/../config/db.php';

$app = new \Slim\App;

// $app->add(function ($request, $response, $next) {
//     $response->getBody()->write("Before ");
//     $response = $next($request, $response);
//     $response->getBody()->write(" After");

//     return $response;
// });

// $app->get("/hello/{name}", function(Request $request, Response $response, array $args) {
//     $name = $args["name"];
//     $response->getBody()->write("Ssup, $name");
//     return $response;
// })->add($ba);


//All routes
// require __DIR__ . '/../src/Middleware/AuthMiddleware.php';
require __DIR__ . '/../src/routes/customers.php';

$app->run();
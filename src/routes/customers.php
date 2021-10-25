<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Middleware;

// require('/../src/Middleware/AuthMiddleware.php');

$app = new \Slim\App;

$app->get("/hello/{name}", \HomeController::class . ':name');

$app->get("/customer/{id}", \HomeController::class . ':getCustId')->add(new authMiddleware());

$app->post("/customers/addcustomer", \HomeController::class . ':custAdd');

// $app->post("/customer/login/{id}", \HomeController::class . ':custLogin');

// $app->group('', function() {
    
// })->add(new AuthMiddleware());

$app->post("/register", \HomeController::class . ':custRegister');

$app->post("/login", \HomeController::class . ':Login')->setName('login');
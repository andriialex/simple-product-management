<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require 'C:\xampp\htdocs\RESTful-API-vueJS-products\vendor\autoload.php';
require 'C:\xampp\htdocs\RESTful-API-vueJS-products\src\config\db.php';

$app = new \Slim\App;

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

require 'C:\xampp\htdocs\RESTful-API-vueJS-products\src\products_route.php';

$app->run();
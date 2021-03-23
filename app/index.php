<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();

$app->addErrorMiddleware(true, true, true);
//$app->setBasePath("/slim4/public");
//$app->setBasePath("/slim4/public/index.php");
$app->setBasePath("/app/index.php");
$app->setBasePath("/index.php");
$app->get('/hola/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Saludar!");
    return $response;
});
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hola mundo slim4!");
    return $response;
});

$app->get('/poo/', function (Request $request, Response $response, array $args) {
    $payload = json_encode(['nombre' => 'Maria'], JSON_PRETTY_PRINT);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});
try {
    $app->run();     
} catch (Exception $e) {    
  // We display a error message
  die( json_encode(array("status" => "failed", "message" => "This action is not allowed"))); 
}
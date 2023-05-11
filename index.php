<?php

use backend\classes\Router;
include './composer.phar/vendor/autoload.php';
include 'config.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$router = new Router();
$response = $router->route($request);

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
    header($name . ': ' . implode(', ', $values));
}
echo $response->getBody();

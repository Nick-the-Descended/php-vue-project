<?php

use backend\classes\ProductService;

require_once '../config/config.php';
require_once '../config/Database.php';
require_once '../classes/ProductService.php';
require_once '../classes/ProductInterface.php';
require_once '../classes/AbstractProduct.php';
require_once '../classes/DVD.php';
require_once '../classes/Book.php';
require_once '../classes/Furniture.php';

$productService = new ProductService();

http_response_code(404);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $productService->getAllProducts();
    http_response_code(201);
}
else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultProduct = $productService->createProduct($_POST);
    http_response_code(201);
}
else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $ids = $_GET['ids'];

    $result = $productService->deleteProducts($ids);
    if ($result > 0) {
        http_response_code(204);
    } else {
        http_response_code(404);
    }
}
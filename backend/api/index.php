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
    if (str_ends_with($_SERVER['REQUEST_URI'], 'getProducts')) {
        $response = $productService->getAllProducts();
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(array_map(fn($x) => $x->serialize(), $response));
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (str_ends_with($_SERVER['REQUEST_URI'], 'createProduct')) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $resultProduct = $productService->createProduct($data);

        if ($resultProduct) {
            //echo "Product created successfully.";
            http_response_code(200);
        } else {
            //echo "Failed to create product.";
            http_response_code(400);
        }
    } else {
        http_response_code(404);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if ($_SERVER['REQUEST_URI'] === '/deleteProducts') {
        if (isset($_GET['skus'])) {
            $skus = json_decode($_GET['skus'], true);

            if (is_array($skus)) {
                $result = $productService->deleteProducts($skus);
                if ($result > 0) {
                    http_response_code(204);
                }
            } else {
                http_response_code(400);
                echo "Invalid request. 'skus' parameter is not a valid JSON array.";
            }
        } else {
            http_response_code(400);
            echo "Invalid request. 'skus' parameter is missing.";
        }
    }
}

/*
//TODO use this code in some js file to handle deletes
const skus = ['sku1', 'sku2', 'sku3'];

const encodedSkus = encodeURIComponent(JSON.stringify(skus));
const url = `http://localhost/php-vue-project/backend/api/index.php/deleteProducts?skus=${encodedSkus}`;

fetch(url, {
  method: 'DELETE',
})
  .then(response => {
    if (response.status === 204) {
      console.log('Products deleted successfully');
    } else {
      console.error('Failed to delete products', response.status);
    }
  })
  .catch(error => console.error('Error:', error));
 * */
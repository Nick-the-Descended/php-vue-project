<?php

use backend\classes\ProductService;

require_once './backend/config/config.php';
require_once './backend/config/Database.php';
require_once './backend/classes/ProductService.php';
require_once './backend/classes/ProductInterface.php';
require_once './backend/classes/AbstractProduct.php';
require_once './backend/classes/DVD.php';
require_once './backend/classes/Book.php';
require_once './backend/classes/Furniture.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");
$productService = new ProductService();
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
http_response_code(404);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $uri = (strtolower(explode('?', $_SERVER['REQUEST_URI'])[0]));
    if (custom_str_ends_with($uri, 'products/getall')) {
        $response = $productService->getAllProducts();
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(array_map(fn($x) => $x->serialize(), $response));
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uri = (strtolower(explode('?', $_SERVER['REQUEST_URI'])[0]));
    //echo $uri;
    if (custom_str_ends_with($uri, 'products/create')) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $resultProduct = $productService->createProduct($data);

        if ($resultProduct) {
            http_response_code(200);
            echo "Product created successfully.";
        } else {
            http_response_code(400);
            echo "Failed to create product.";
        }
    } else {
        http_response_code(404);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $uri = (strtolower(explode('?', $_SERVER['REQUEST_URI'])[0]));
    if (custom_str_ends_with($uri, 'products/delete')) {
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

function custom_str_ends_with(string $haystack, string $needle): bool
{
    $needle_len = strlen($needle);
    if ($needle_len === 0) {
        return true;
    }
    if (substr($haystack, -$needle_len) === $needle) {
        return true;
    }
    // Check if the last character of the haystack is a forward slash
    if (str_ends_with($haystack, '/') && substr($haystack, -$needle_len - 1, 1) !== '/') {
        // If the needle does not end with a forward slash, and the last character of the haystack is a forward slash
        // we need to check if the characters before the forward slash match the needle
        return (substr($haystack, -$needle_len - 1, $needle_len) === $needle);
    }
    return false;
}

// TODO delete
// const encodedSkus = encodeURIComponent(JSON.stringify(skus));
// const url = `https://php-vue-project.000webhostapp.com/products/delete?skus=${encodedSkus}`

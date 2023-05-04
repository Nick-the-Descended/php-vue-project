<?php
require_once 'classes/ProductDatabase.php';
require_once 'classes/ProductInterface.php';
require_once 'classes/AbstractProduct.php';
require_once 'config.php';
require_once 'classes/DVD.php';
require_once 'classes/Book.php';
require_once 'classes/Furniture.php';

$action = $_GET['action'] ?? 'list';


$productDatabase = new ProductDatabase();

switch ($action) {
    case 'list':
        $products = $productDatabase->getAllProducts();
        include 'templates/index.html.php';
        break;
    case 'add-product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sku = $_POST['sku'];
            $name = $_POST['name'];
            $price = floatval($_POST['price']);
            $productType = $_POST['productType'];

            $finalProduct = null;


            switch ($productType) {
                case 'DVD':
                    $finalProduct = ProductFactory::createDVD(
                        $sku,
                        $name,
                        $price,
                        $_POST
                    );
                    break;
                case 'Book':
                    $finalProduct = ProductFactory::createBook(
                        $sku,
                        $name,
                        $price,
                        floatval($_POST['wight'])
                    );
                    break;
                case 'Furniture':
                    $finalProduct = ProductFactory::createFurniture(
                        $sku,
                        $name,
                        $price,
                        intval($_POST['height']),
                        intval($_POST['width']),
                        intval($_POST['length'])
                    );
                    break;
            }

            $productDatabase->saveProduct($finalProduct);

            header('Location: index.php');
            exit();
        } else {
            include 'templates/add-product.html.php';
        }
        break;
    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productIds = $_POST['productIds'];
            $productDatabase->deleteProducts($productIds);
        }
        header('Location: index.php');
        break;
}
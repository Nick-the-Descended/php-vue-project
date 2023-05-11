<?php

namespace backend\classes;

use backend\classes\config\Database;
use mysqli_result;

class ProductService
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function findSku(string $sku)
    {
        $query = "SELECT * FROM products WHERE sku = $sku";
        return !!$this->database->execute($query)->fetch_row();
    }

    public function getAllProducts(): array
    {
        $query = "SELECT * FROM products ORDER BY createdOn";
        $result = $this->database->execute($query);
        $products = [];

        if (!$result) {
            return [];
        }

        while ($row = $result->fetch_assoc()) {
            $product = $this->createProductFromRow($row);
            if ($product) {
                $products[] = $product;
            }
        }

        return $products;
    }

//    public function validateDefaults(string $sku, string $name, float $price): bool
//    {
//        return strlen($sku) > 0 && strlen($name) && $price > 0 && !ProductService::findSku($sku);
//    }
//
//    public function validateSize(?int $size): bool
//    {
//        return $size && $size > 0;
//    }
//
//    public function validateDimensions(?float $height, ?float $width, ?float $length): bool
//    {
//        return $height && $width && $length && $height > 0 && $width > 0 && $length > 0;
//    }
    public function isValidSku(string $sku): bool
    {
        return !$this->database->execute("SELECT * from products where sku = '$sku'")->fetch_row();
    }

    private function createProductFromRow($row): ?ProductInterface
    {
        return match ($row['product_type']) {
            "Book" => $this->createBook($row),
            "Furniture" => $this->createFurniture($row),
            "DVD" => $this->createDVD($row),
            default => null,
        };
    }

    public function deleteProducts(array $skus): int
    {
        $escapedSkus = array_map(function ($sku) {
            return "'" . $this->database->escape_string($sku) . "'";
        }, $skus);

        $skuList = implode(',', $escapedSkus);

        $query = "DELETE FROM products WHERE sku IN ({$skuList})";
        return $this->database->execute($query);
    }


    public function createProduct(array $post): mysqli_result|bool
    {
        $sku = $post['sku'];
        $name = $post['name'];
        $price = $post['price'];
        $productType = $post['type'];
        $attribute = $post['attribute'];

        if (!$this->isValidSku($sku)) {
            echo "invalid SKU\n";
            return false;
        }

        $query = "INSERT INTO products
                    (`sku`, `name`, `price`, `product_type`, `attribute`) 
                    VALUES ('$sku', '$name', $price, '$productType', '$attribute')";

        return $this->database->execute($query);
    }

    private function addDefaultParameters(ProductInterface $product, $row)
    {
        return $product
            ->setSku($row['sku'])
            ->setName($row['name'])
            ->setPrice($row['price']);
    }

    private function createBook($row): Book
    {
        $product = new Book();
        $product->setWeight(floatval($row['attribute']));

        return $this->addDefaultParameters($product, $row);
    }

    private function createDVD($row): DVD
    {
        $product = new DVD();
        $product->setSize(floatval($row['attribute']));

        return $this->addDefaultParameters($product, $row);
    }

    private function createFurniture($row): Furniture
    {
        $product = new Furniture();
        $product->setDimensions($row['attribute']);

        return $this->addDefaultParameters($product, $row);
    }


}

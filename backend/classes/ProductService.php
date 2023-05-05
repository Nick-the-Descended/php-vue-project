<?php

namespace backend\classes;

use backend\config\Database;
use mysqli;
use PDOStatement;

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
        $query = "SELECT * FROM products ORDER BY id";
        $result = $this->database->execute($query);
        $products = [];

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

    private function createProductFromRow($row): ?ProductInterface
    {
        return match ($row['product_type']) {
            "Book" => $this->createBook($row),
            "Furniture" => $this->createFurniture($row),
            "DVD" => $this->createDVD($row),
            default => null,
        };
    }

    public function saveProduct(ProductInterface $product): bool
    {
        $sku = $product->getSku();
        $name = $product->getName();
        $price = $product->getPrice();
        $attributes = $product->getAttributes();


        if ($product instanceof DVD) {
            $productType = 'DVD';
            $size = $attributes['Size'];
        } elseif ($product instanceof Book) {
            $productType = 'Book';
            $weight = $attributes['Weight'];
        } elseif ($product instanceof Furniture) {
            $productType = 'Furniture';
            $dimensions = explode("x", $attributes['Dimensions']);
            $height = $dimensions[0];
            $width = $dimensions[1];
            $length = $dimensions[2];
        }

        $query = "INSERT INTO products (sku, name, price, product_type, size, weight, height, width, length)
          VALUES (:sku, :name, :price, :productType, :size, :weight, :height, :width, :length)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            'sku' => $sku,
            'name' => $name,
            'price' => $price,
            'productType' => $productType,
            'size' => $size,
            'weight' => $weight,
            'height' => $height,
            'width' => $width,
            'length' => $length,
        ]);

        return $stmt->rowCount();
    }

    public function deleteProducts($productIds): int
    {
//        mysqli_query($db, "INSERT INTO products (products.name, products.price) VALUES ('$name', '$price')");
        $query = "DELETE FROM products WHERE id IN (" . implode(',', $productIds) . ")";
        return $this->connection->query($query);
    }

    public function createProduct(array $post)
    {

    }

    private function addDefaultParameters(ProductInterface $product, $row)
    {
        return $product
            ->setId($row['id'])
            ->setSku($row['sku'])
            ->setName($row['name'])
            ->setPrice($row['price']);
    }

    private function createBook($row): Book
    {
        $product = new Book();
        $product->setWeight($row['weight']);

        return $this->addDefaultParameters($product, $row);
    }

    private function createDVD($row): DVD
    {
        $product = new DVD();
        $product->setSize($row['size']);

        return $this->addDefaultParameters($product, $row);
    }

    private function createFurniture($row): Furniture
    {
        $product = new Furniture();
        $product->setDimensions($row['dimensions']);

        return $this->addDefaultParameters($product, $row);
    }
}

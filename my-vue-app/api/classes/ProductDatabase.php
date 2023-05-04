<?php

class ProductDatabase
{
    private PDO $connection;

    public function __construct()
    {

        $dbHost = HOST;
        $dbName = USERNAME;
        $dbUser = DATABASE;
        $dbPassword = PASSWORD;

        $pdoConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
        $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection = $pdoConnection;
    }

    public static function findSku(string $sku)
    {

    }

    public function getAllProducts(): array
    {
        $query = "SELECT * FROM products ORDER BY id";
        $result = $this->connection->query($query);
        $products = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $product = $this->createProductFromRow($row);
            if ($product) {
                $products[] = $product;
            }
        }

        return $products;
    }

    private function createProductFromRow($row): ?ProductInterface
    {
        $productType = $row['product_type'];
        $sku = $row['sku'];
        $name = $row['name'];
        $price = $row['price'];

        switch ($productType) {
            case 'DVD':
                $size = $row['size'];
                return ProductFactory::createDVD($sku, $name, $price, $size);
            case 'Book':
                $weight = $row['weight'];
                return ProductFactory::createBook($sku, $name, $price, $weight);
            case 'Furniture':
                $height = $row['height'];
                $width = $row['width'];
                $length = $row['length'];
                return ProductFactory::createFurniture($sku, $name, $price, $height, $width, $length);
            default:
                return null;
        }
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

    public function deleteProducts($productIds): false|PDOStatement
    {
        $query = "DELETE FROM products WHERE id IN (" . implode(',', $productIds) . ")";
        return $this->connection->query($query);
    }
}

?>

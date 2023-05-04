<?php

class ProductFactory
{
//    public static function createProduct(
//        string $type,
//        string $sku,
//        string $name,
//        float  $price,
//               $attribute1 = null,
//               $attribute2 = null,
//               $attribute3 = null
//    ): ProductInterface
//    {
//        switch ($type) {
//            case 'dvd':
//                return new DVD($sku, $name, $price, $attribute1);
//            case 'book':
//                return new Book($sku, $name, $price, $attribute1);
//            case 'furniture':
//                return new Furniture($sku, $name, $price, $attribute1, $attribute2, $attribute3);
//            default:
//                throw new InvalidArgumentException("Invalid product type: $type");
//        }
//    }

    public static function createDVD(
        string $sku,
        string $name,
        float  $price,
        array  $args
    ): ProductInterface
    {
        if (!self::validateSize($args['size']))
            throw new InvalidArgumentException('Invalid DVD size');


        $dvd = new DVD();

        $dvd->setSku($sku)
            ->setName($name)
            ->setPrice($price)
            ->setSize($args['size']);

        return $dvd;
    }

    public static function createBook(
        string $sku,
        string $name,
        float  $price,
        array  $args
    ): ProductInterface
    {
        $book = new Book();
        $book->setSku($sku)
            ->setName($name)
            ->setPrice($price)
            ->setWeight($args['weight']);
        return $book;
    }

    public static function createFurniture(
        string $sku,
        string $name,
        float  $price,
        array  $args
    ): ProductInterface
    {
        if (!self::validateDimensions($args['height'], $args['width'], $args['length']))
            throw new InvalidArgumentException('Invalid dimensions');

        $furniture = new Furniture();
        $furniture->setSku($sku)
            ->setName($name)
            ->setPrice($price)
            ->setHeight($args['height'])
            ->setWidth($args['width'])
            ->setLength($args['length']);
        return $furniture;
    }

    public static function validateDefaults(string $sku, string $name, float $price): bool
    {
        return strlen($sku) > 0 && strlen($name) && $price > 0 && !ProductDatabase::findSku($sku);
    }

    public static function validateSize(?int $size): bool
    {
        return $size && $size > 0;
    }

    public static function validateDimensions(?float $height, ?float $width, ?float $length): bool
    {
        return $height && $width && $length && $height > 0 && $width > 0 && $length > 0;
    }


}
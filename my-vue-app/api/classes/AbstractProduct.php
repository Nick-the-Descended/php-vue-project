<?php

abstract class AbstractProduct implements ProductInterface
{
    private int $id;
    private string $sku;
    private string $name;
    private float $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AbstractProduct
     */
    public function setId(int $id): AbstractProduct
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return AbstractProduct
     */
    public function setSku(string $sku): AbstractProduct
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AbstractProduct
     */
    public function setName(string $name): AbstractProduct
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return AbstractProduct
     */
    public function setPrice(float $price): AbstractProduct
    {
        $this->price = $price;
        return $this;
    }

}

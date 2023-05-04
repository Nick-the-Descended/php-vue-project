<?php

class Book extends AbstractProduct
{
    private float $weight;

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return Book
     */
    public function setWeight(float $weight): Book
    {
        $this->weight = $weight;
        return $this;
    }

    public function getAttributes(): array
    {
        return ['weight' => $this->weight];
    }

}

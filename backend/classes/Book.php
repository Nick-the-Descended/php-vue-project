<?php

namespace backend\classes;

use InvalidArgumentException;

class Book extends AbstractProduct
{
    private float $weight;

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): Book
    {
        if ($weight < 0) {
            throw new InvalidArgumentException('DVD size cannot be negative.');
        }

        $this->weight = $weight;
        return $this;
    }

}

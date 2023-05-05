<?php

namespace backend\classes;

class Furniture extends AbstractProduct
{
    private string $dimensions;

    public function getDimensions(): string
    {
        return $this->dimensions;
    }

    public function setDimensions(string $dimensions): Furniture
    {
        $this->dimensions = $dimensions;
        return $this;
    }
}

<?php

namespace backend\classes;

use InvalidArgumentException;

class DVD extends AbstractProduct
{
    private int $size;

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): DVD
    {
        if ($size < 0) {
            throw new InvalidArgumentException('DVD size cannot be negative.');
        }

        $this->size = $size;
        return $this;
    }
}

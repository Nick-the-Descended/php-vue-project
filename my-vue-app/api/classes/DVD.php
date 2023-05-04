<?php

class DVD extends AbstractProduct
{
    private int $size;

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return DVD
     */
    public function setSize(int $size): DVD
    {
        if ($size < 0) {
            throw new InvalidArgumentException('DVD size cannot be negative.');
        }

        $this->size = $size;
        return $this;
    }


    public function getAttributes(): array
    {
        return ['size' => $this->size];
    }

}

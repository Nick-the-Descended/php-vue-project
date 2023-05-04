<?php
class Furniture extends AbstractProduct
{
    private float $height;
    private float $width;
    private float $length;

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $height
     * @return Furniture
     */
    public function setHeight(float $height): Furniture
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @param float $width
     * @return Furniture
     */
    public function setWidth(float $width): Furniture
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * @param float $length
     * @return Furniture
     */
    public function setLength(float $length): Furniture
    {
        $this->length = $length;
        return $this;
    }

    public function getAttributes(): array
    {
        return [
            'height' => $this->height,
            'width' => $this->width,
            'length' => $this->length,
        ];
    }

}

?>
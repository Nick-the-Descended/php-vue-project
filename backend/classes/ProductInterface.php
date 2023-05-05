<?php

namespace backend\classes;
interface ProductInterface
{
    public function getSku(): string;

    public function getName(): string;

    public function getPrice(): float;

}
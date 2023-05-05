<?php

namespace backend\classes;
interface ProductInterface
{
    public function getId(): int;

    public function getSku(): string;

    public function getName(): string;

    public function getPrice(): float;

}
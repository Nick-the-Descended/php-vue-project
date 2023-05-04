<?php
interface ProductInterface {
    public function getId(): int;
    public function getSku(): string;
    public function getName(): string;
    public function getPrice(): float;
    public function getAttributes(): array;
}
?>
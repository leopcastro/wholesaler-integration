<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment\Product;

interface Product
{
    public function getId(): string;

    public function getGtin(): string;

    public function setGtin(string $gtin): void;

    public function getManufacturer(): string;

    public function setManufacturer(string $manufacturer): void;

    public function getName(): string;

    public function setName(string $name): void;

    public function getPackaging(): Packaging;

    public function setPackaging(Packaging $packaging): void;

    public function getBaseProductPackaging(): BaseProductPackaging;

    public function setBaseProductPackaging(BaseProductPackaging $baseProductPackaging): void;

    public function getBaseProductUnit(): string;

    public function setBaseProductUnit(string $baseProductUnit): void;

    public function getBaseProductAmount(): string;

    public function setBaseProductAmount(string $baseProductAmount): void;

    public function getBaseProductQuantity(): string;

    public function setBaseProductQuantity(string $baseProductQuantity): void;
}

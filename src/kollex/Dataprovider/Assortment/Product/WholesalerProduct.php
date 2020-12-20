<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment\Product;

class WholesalerProduct implements Product
{
    private string $id;
    private string $gtin;
    private string $manufacturer;
    private string $name;
    private Packaging $packaging;
    private BaseProductPackaging $baseProductPackaging;
    private string $baseProductUnit;
    private string $baseProductAmount;
    private string $baseProductQuantity;

    public function __construct(
        string $id,
        string $manufacturer,
        string $name,
        Packaging $packaging,
        BaseProductPackaging $baseProductPackaging,
        string $baseProductUnit,
        string $baseProductAmount,
        string $baseProductQuantity
    ) {
        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->name = $name;
        $this->packaging = $packaging;
        $this->baseProductPackaging = $baseProductPackaging;
        $this->baseProductUnit = $baseProductUnit;
        $this->baseProductAmount = $baseProductAmount;
        $this->baseProductQuantity = $baseProductQuantity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getGtin(): string
    {
        return $this->gtin;
    }

    public function setGtin(string $gtin): void
    {
        $this->gtin = $gtin;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPackaging(): Packaging
    {
        return $this->packaging;
    }

    public function setPackaging(Packaging $packaging): void
    {
        $this->packaging = $packaging;
    }

    public function getBaseProductPackaging(): BaseProductPackaging
    {
        return $this->baseProductPackaging;
    }

    public function setBaseProductPackaging(BaseProductPackaging $baseProductPackaging): void
    {
        $this->baseProductPackaging = $baseProductPackaging;
    }

    public function getBaseProductUnit(): string
    {
        return $this->baseProductUnit;
    }

    public function setBaseProductUnit(string $baseProductUnit): void
    {
        $this->baseProductUnit = $baseProductUnit;
    }

    public function getBaseProductAmount(): string
    {
        return $this->baseProductAmount;
    }

    public function setBaseProductAmount(string $baseProductAmount): void
    {
        $this->baseProductAmount = $baseProductAmount;
    }

    public function getBaseProductQuantity(): string
    {
        return $this->baseProductQuantity;
    }

    public function setBaseProductQuantity(string $baseProductQuantity): void
    {
        $this->baseProductQuantity = $baseProductQuantity;
    }
}

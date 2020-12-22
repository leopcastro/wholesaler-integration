<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\Product\BaseProductPackaging;
use kollex\Dataprovider\Assortment\Product\BaseProductUnit;
use kollex\Dataprovider\Assortment\Product\Packaging;
use kollex\Dataprovider\Assortment\Product\Product;
use kollex\Dataprovider\Assortment\Product\WholesalerProduct;
use kollex\Dataprovider\Assortment\ProductArrayTransformer;
use PHPUnit\Framework\TestCase;

class ProductArrayTransformerTest extends TestCase
{
    private const ID = 'id';
    private const MANUFACTURER = 'manufacturer';
    private const NAME = 'name';
    private const PACKAGING = Packaging::BOX;
    private const BASE_PRODUCT_PACKAGING = BaseProductPackaging::BOTTLE;
    private const BASE_PRODUCT_UNIT = BaseProductUnit::LITERS;
    private const BASE_PRODUCT_AMOUNT = 1.0;
    private const BASE_PRODUCT_QUANTITY = 12;
    private const GTIN = 'gtin';

    private ProductArrayTransformer $productArrayTransformer;

    protected function setUp(): void
    {
        $this->productArrayTransformer = new ProductArrayTransformer();
    }

    public function testTransformProduct(): void
    {
        $transformedProduct = $this->productArrayTransformer->transform($this->getTestProduct());

        $this->assertCount(9, $transformedProduct);

        $this->assertEquals(self::ID, $transformedProduct['id']);
        $this->assertEquals(self::GTIN, $transformedProduct['gtin']);
        $this->assertEquals(self::MANUFACTURER, $transformedProduct['manufacturer']);
        $this->assertEquals(self::NAME, $transformedProduct['name']);
        $this->assertEquals(self::PACKAGING, $transformedProduct['packaging']);
        $this->assertEquals(self::BASE_PRODUCT_PACKAGING, $transformedProduct['baseProductPackaging']);
        $this->assertEquals(self::BASE_PRODUCT_UNIT, $transformedProduct['baseProductUnit']);
        $this->assertEquals(self::BASE_PRODUCT_AMOUNT, $transformedProduct['baseProductAmount']);
        $this->assertEquals(self::BASE_PRODUCT_QUANTITY, $transformedProduct['baseProductQuantity']);
    }

    public function testTransformProductWithoutGtin(): void
    {
        $product = $this->getTestProduct();
        $product->setGtin('');

        $transformedProduct = $this->productArrayTransformer->transform($product);

        $this->assertCount(8, $transformedProduct);
        $this->assertArrayNotHasKey('gtin', $transformedProduct);
    }

    private function getTestProduct(): Product
    {
        $product = new WholesalerProduct(
            self::ID,
            self::MANUFACTURER,
            self::NAME,
            new Packaging(self::PACKAGING),
            new BaseProductPackaging(self::BASE_PRODUCT_PACKAGING),
            new BaseProductUnit(self::BASE_PRODUCT_UNIT),
            self::BASE_PRODUCT_AMOUNT,
            self::BASE_PRODUCT_QUANTITY
        );

        $product->setGtin(self::GTIN);

        return $product;
    }
}

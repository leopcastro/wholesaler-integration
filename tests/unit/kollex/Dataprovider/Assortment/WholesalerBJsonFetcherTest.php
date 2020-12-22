<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\CsvReader;
use kollex\Dataprovider\Assortment\JsonFileDataReader;
use kollex\Dataprovider\Assortment\Product\Product;
use kollex\Dataprovider\Assortment\WholesalerBJsonFetcher;
use kollex\Dataprovider\Assortment\WholesalerBJsonNormalizer;
use PHPUnit\Framework\TestCase;

class WholesalerBJsonFetcherTest extends TestCase
{
    /**
     * @var WholesalerBJsonNormalizer|\PHPUnit\Framework\MockObject\MockObject
     */
    private $wholesalerBJsonNormalizer;

    private WholesalerBJsonFetcher $wholesalerBJsonFetcher;

    /**
     * @var CsvReader|\PHPUnit\Framework\MockObject\MockObject
     */
    private $jsonFileDataReader;

    protected function setUp(): void
    {
        $this->wholesalerBJsonNormalizer = $this->createMock(WholesalerBJsonNormalizer::class);
        $this->jsonFileDataReader = $this->createMock(JsonFileDataReader::class);

        $this-> wholesalerBJsonFetcher = new WholesalerBJsonFetcher(
            $this->wholesalerBJsonNormalizer,
            $this->jsonFileDataReader
        );
    }

    public function testGetProduct()
    {
        $jsonItem = [
            'PRODUCT_IDENTIFIER' => 'id',
            'EAN_CODE_GTIN' => 'gtin',
            'BRAND' => 'manufacturer',
            'NAME' => 'name',
            'PACKAGE' => 'mocked',
            'VESSEL' => 'mocked',
            'LITERS_PER_BOTTLE' => 'mocked',
            'BOTTLE_AMOUNT' => 'mocked',
        ];

        $this->jsonFileDataReader->method('getData')->willReturn($jsonItem);

        $packaging = 'CA';
        $baseProductPackaging = 'BO';
        $baseProductUnit = 'LT';
        $baseProductAmount = 1.0;
        $baseProductQuantity = 12;

        $this->wholesalerBJsonNormalizer->method('getPackagingValue')->willReturn($packaging);
        $this->wholesalerBJsonNormalizer->method('getBaseProductPackagingValue')->willReturn($baseProductPackaging);
        $this->wholesalerBJsonNormalizer->method('getBaseProductAmountValue')->willReturn($baseProductAmount);
        $this->wholesalerBJsonNormalizer->method('getBaseProductQuantityValue')->willReturn($baseProductQuantity);

        $product = $this->wholesalerBJsonFetcher->getProduct();

        $this->assertInstanceOf(Product::class, $product);

        $this->assertEquals('id', $product->getId());
        $this->assertEquals('manufacturer', $product->getManufacturer());
        $this->assertEquals('name', $product->getName());
        $this->assertEquals($packaging, $product->getPackaging()->getType());
        $this->assertEquals($baseProductPackaging, $product->getBaseProductPackaging()->getType());
        $this->assertEquals($baseProductUnit, $product->getBaseProductUnit()->getType());
        $this->assertEquals($baseProductAmount, $product->getBaseProductAmount());
        $this->assertEquals($baseProductQuantity, $product->getBaseProductQuantity());

        $this->assertEquals('gtin', $product->getGtin());
    }

    public function testNoProductWhenNoDataFromReader()
    {
        $this->jsonFileDataReader->method('getData')->willReturn(null);

        $product = $this->wholesalerBJsonFetcher->getProduct();

        $this->assertEquals(null, $product);
    }
}

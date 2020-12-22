<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\CsvReader;
use kollex\Dataprovider\Assortment\WholesalerACsvFetcher;
use kollex\Dataprovider\Assortment\Product\Product;
use kollex\Dataprovider\Assortment\WholesalerACsvNormalizer;
use PHPUnit\Framework\TestCase;

class WholesalerACsvFetcherTest extends TestCase
{
    /**
     * @var WholesalerACsvNormalizer|\PHPUnit\Framework\MockObject\MockObject
     */
    private $wholesalerACsvNormalizer;

    private WholesalerACsvFetcher $wholesalerACsvFetcher;

    /**
     * @var CsvReader|\PHPUnit\Framework\MockObject\MockObject
     */
    private $csvReader;

    protected function setUp(): void
    {
        $this->wholesalerACsvNormalizer = $this->createMock(WholesalerACsvNormalizer::class);
        $this->csvReader = $this->createMock(CsvReader::class);

        $this-> wholesalerACsvFetcher = new WholesalerACsvFetcher($this->wholesalerACsvNormalizer, $this->csvReader);
    }

    public function testGetProduct()
    {
        $csvRow = [
            0 => 'id',
            1 => 'gtin',
            2 => 'manufacturer',
            3 => 'name',
            5 => 'mocked',
            7 => 'mocked',
            8 => 'mocked',
        ];

        $this->csvReader->method('getData')->willReturn($csvRow);

        $packaging = 'CA';
        $baseProductPackaging = 'BO';
        $baseProductUnit = 'LT';
        $baseProductAmount = 1.0;
        $baseProductQuantity = 12;

        $this->wholesalerACsvNormalizer->method('getPackagingValue')->willReturn($packaging);
        $this->wholesalerACsvNormalizer->method('getBaseProductPackagingValue')->willReturn($baseProductPackaging);
        $this->wholesalerACsvNormalizer->method('getBaseProductUnitValue')->willReturn($baseProductUnit);
        $this->wholesalerACsvNormalizer->method('getBaseProductAmountValue')->willReturn($baseProductAmount);
        $this->wholesalerACsvNormalizer->method('getBaseProductQuantityValue')->willReturn($baseProductQuantity);

        $product = $this->wholesalerACsvFetcher->getProduct();

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
        $this->csvReader->method('getData')->willReturn(null);

        $product = $this->wholesalerACsvFetcher->getProduct();

        $this->assertEquals(null, $product);
    }
}

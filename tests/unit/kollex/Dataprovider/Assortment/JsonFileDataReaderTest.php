<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\FileNotFound;
use kollex\Dataprovider\Assortment\JsonFileDataReader;
use PHPUnit\Framework\TestCase;

class JsonFileDataReaderTest extends TestCase
{
    private const CSV_FIXUTRE_PATH = __DIR__ . '/Fixtures/wholesaler_b_sample.json';

    private JsonFileDataReader $jsonFileDataReader;

    protected function setUp(): void
    {
        $this->jsonFileDataReader = new JsonFileDataReader(self::CSV_FIXUTRE_PATH);
    }

    public function testCantInstantiateWhenFileNotFound()
    {
        $filePath = 'non_existent_file';

        $this->expectException(FileNotFound::class);
        $this->expectExceptionMessageMatches('/' . $filePath . '/');

        new JsonFileDataReader($filePath);
    }

    public function testCanGetFirstItem(): void
    {
        $jsonItem = $this->jsonFileDataReader->getData();

        $this->assertCount(9, $jsonItem);
        $this->assertEquals('12345', $jsonItem['PRODUCT_IDENTIFIER']);
        $this->assertEquals('67890', $jsonItem['EAN_CODE_GTIN']);
    }

    public function testCanGetSecondtem(): void
    {
        $this->jsonFileDataReader->getData();
        $jsonItem = $this->jsonFileDataReader->getData();

        $this->assertCount(9, $jsonItem);
        $this->assertEquals('23456', $jsonItem['PRODUCT_IDENTIFIER']);
        $this->assertEquals('78901', $jsonItem['EAN_CODE_GTIN']);
    }

    public function testReturnNullWhenNoMoreItemsToReturn()
    {
        $this->jsonFileDataReader->getData();
        $this->jsonFileDataReader->getData();

        $jsonItem = $this->jsonFileDataReader->getData();

        $this->assertEquals(null, $jsonItem);
    }
}

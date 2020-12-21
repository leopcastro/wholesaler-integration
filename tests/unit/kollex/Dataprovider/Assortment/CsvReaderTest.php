<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\CsvReader;
use kollex\Dataprovider\Assortment\FileNotFound;
use PHPUnit\Framework\TestCase;

class CsvReaderTest extends TestCase
{
    private const CSV_FIXUTRE_PATH = __DIR__ . '/Fixtures/wholesalerASample.csv';

    private CsvReader $csvReader;

    protected function setUp(): void
    {
        $this->csvReader = new CsvReader(self::CSV_FIXUTRE_PATH);
    }

    public function testCantInstantiateWhenFileNotFound()
    {
        $filePath = 'non_existent_file';

        $this->expectException(FileNotFound::class);
        $this->expectExceptionMessageMatches('/' . $filePath . '/');

        new CsvReader($filePath);
    }

    public function testSkipsHeader()
    {
        $data = $this->csvReader->getData();

        $this->assertNotEquals('id', $data[0]);
    }

    public function testCanGetFirstRow()
    {
        $data = $this->csvReader->getData();

        $this->assertCount(11, $data);
        $this->assertEquals('12345', $data[0]);
        $this->assertEquals('67890', $data[1]);
    }

    public function testCanGetSecondRow()
    {
        $this->csvReader->getData();
        $data = $this->csvReader->getData();

        $this->assertCount(11, $data);
        $this->assertEquals('23456', $data[0]);
        $this->assertEquals('78901', $data[1]);
    }

    public function testReturnNullWhenAtEndOfFile()
    {
        $this->csvReader->getData();
        $this->csvReader->getData();
        $data = $this->csvReader->getData();

        $this->assertEquals(null, $data);
    }
}

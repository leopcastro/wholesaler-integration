<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment\Product;

use kollex\Dataprovider\Assortment\Product\InvalidType;
use kollex\Dataprovider\Assortment\Product\Packaging;
use PHPUnit\Framework\TestCase;

class PackagingTest extends TestCase
{
    /**
     * @dataProvider packagingAllowedTypesDataProvider
     */
    public function testCanCreateWithAllowedType(string $packagingType): void
    {
        $packaging = new Packaging($packagingType);

        $this->assertEquals($packagingType, $packaging->getType());
    }

    public function packagingAllowedTypesDataProvider(): array
    {
        return [
          ['CA'],
          ['BX'],
          ['BO'],
        ];
    }

    /**
     * @dataProvider packagingInvalidTypesDataProvider
     */
    public function testCannotCreateWithInvalidTypes(string $packagingType): void
    {
        $this->expectException(InvalidType::class);

        new Packaging($packagingType);
    }

    public function packagingInvalidTypesDataProvider(): array
    {
        return [
            ['ca'],
            ['Ca'],
            ['cA'],
            [''],
        ];
    }
}

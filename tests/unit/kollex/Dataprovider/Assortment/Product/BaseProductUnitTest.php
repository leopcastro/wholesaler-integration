<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment\Product;

use kollex\Dataprovider\Assortment\Product\InvalidType;
use kollex\Dataprovider\Assortment\Product\BaseProductUnit;
use PHPUnit\Framework\TestCase;

class BaseProductUnitTest extends TestCase
{
    /**
     * @dataProvider allowedTypesDataProvider
     */
    public function testCanCreateWithAllowedType(string $packagingType): void
    {
        $packaging = new BaseProductUnit($packagingType);

        $this->assertEquals($packagingType, $packaging->getType());
    }

    public function allowedTypesDataProvider(): array
    {
        return [
          ['LT'],
          ['GR'],
        ];
    }

    /**
     * @dataProvider invalidTypesDataProvider
     */
    public function testCannotCreateWithInvalidTypes(string $packagingType): void
    {
        $this->expectException(InvalidType::class);

        new BaseProductUnit($packagingType);
    }

    public function invalidTypesDataProvider(): array
    {
        return [
            ['lt'],
            ['Lt'],
            ['lT'],
            [''],
        ];
    }
}

<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment\Product;

use kollex\Dataprovider\Assortment\Product\InvalidType;
use kollex\Dataprovider\Assortment\Product\BaseProductPackaging;
use PHPUnit\Framework\TestCase;

class BaseProductPackagingTest extends TestCase
{
    /**
     * @dataProvider allowedTypesDataProvider
     */
    public function testCanCreateWithAllowedType(string $packagingType): void
    {
        $packaging = new BaseProductPackaging($packagingType);

        $this->assertEquals($packagingType, $packaging->getType());
    }

    public function allowedTypesDataProvider(): array
    {
        return [
          ['BO'],
          ['CN'],
        ];
    }

    /**
     * @dataProvider invalidTypesDataProvider
     */
    public function testCannotCreateWithInvalidTypes(string $packagingType): void
    {
        $this->expectException(InvalidType::class);

        new BaseProductPackaging($packagingType);
    }

    public function invalidTypesDataProvider(): array
    {
        return [
            ['bo'],
            ['Bo'],
            ['bO'],
            [''],
        ];
    }
}

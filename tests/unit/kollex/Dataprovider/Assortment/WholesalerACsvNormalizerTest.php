<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\WholesalerACsvNormalizer;
use PHPUnit\Framework\TestCase;

class WholesalerACsvNormalizerTest extends TestCase
{
    private WholesalerACsvNormalizer $wholesalerACsvNormalizer;

    protected function setUp(): void
    {
        $this->wholesalerACsvNormalizer = new WholesalerACsvNormalizer();
    }

    /**
     * @dataProvider getBaseProductAmountValueDataProvider
     */
    public function testGetBaseProductAmountValue(string $rawValue, float $expectedReturn): void
    {
        $amount = $this->wholesalerACsvNormalizer->getBaseProductAmountValue($rawValue);

        $this->assertEquals($expectedReturn, $amount);
    }

    public function getBaseProductAmountValueDataProvider(): array
    {
        return [
            ['', 0.0],
            ['1.0l', 1.0],
            ['0.5l', 0.5],
            ['3.0', 3.0],
            ['40.5', 40.5]
        ];
    }

    /**
     * @dataProvider getBaseProductUnitValueDataProvider
     */
    public function testGetBaseProductUnitValue(string $rawValue, string $expectedReturn): void
    {
        $amount = $this->wholesalerACsvNormalizer->getBaseProductUnitValue($rawValue);

        $this->assertEquals($expectedReturn, $amount);
    }

    public function getBaseProductUnitValueDataProvider(): array
    {
        return [
            ['', ''],
            ['1.0l', 'LT'],
            ['0.5l', 'LT'],
            ['3.0', ''],
            ['abc', '']
        ];
    }

    /**
     * @dataProvider getBaseProductPackagingValueDataProvider
     */
    public function testGetBaseProductPackagingValue(string $rawValue, string $expectedReturn): void
    {
        $amount = $this->wholesalerACsvNormalizer->getBaseProductPackagingValue($rawValue);

        $this->assertEquals($expectedReturn, $amount);
    }

    public function getBaseProductPackagingValueDataProvider(): array
    {
        return [
            ['', ''],
            ['bottle', 'BO'],
            ['can', 'CN'],
            ['3.0', ''],
            ['abc', '']
        ];
    }

    /**
     * @dataProvider getBaseProductQuantityValueDataProvider
     */
    public function testGetBaseProductQuantityValue(string $rawValue, int $expectedReturn): void
    {
        $amount = $this->wholesalerACsvNormalizer->getBaseProductQuantityValue($rawValue);

        $this->assertEquals($expectedReturn, $amount);
    }

    public function getBaseProductQuantityValueDataProvider(): array
    {
        return [
            ['', 0],
            ['single', 1],
            ['case 12', 12],
            ['box 6', 6],
            ['abc', 0]
        ];
    }

    /**
     * @dataProvider getProductPackagingValueDataProvider
     */
    public function testGetProductPackagingValue(string $rawValue, string $expectedReturn): void
    {
        $amount = $this->wholesalerACsvNormalizer->getPackagingValue($rawValue);

        $this->assertEquals($expectedReturn, $amount);
    }

    public function getProductPackagingValueDataProvider(): array
    {
        return [
            ['', ''],
            ['case 12', 'CA'],
            ['single', 'BO'],
            ['box 6', 'BX'],
            ['abc', '']
        ];
    }
}

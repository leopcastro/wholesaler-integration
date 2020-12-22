<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\WholesalerBJsonNormalizer;
use PHPUnit\Framework\TestCase;

class WholesalerBJsonNormalizerTest extends TestCase
{
    private WholesalerBJsonNormalizer $wholesalerBJsonNormalizer;

    protected function setUp(): void
    {
        $this->wholesalerBJsonNormalizer = new WholesalerBJsonNormalizer();
    }

    /**
     * @dataProvider getBaseProductAmountValueDataProvider
     */
    public function testGetBaseProductAmountValue(string $rawValue, float $expectedReturn): void
    {
        $amount = $this->wholesalerBJsonNormalizer->getBaseProductAmountValue($rawValue);

        $this->assertEquals($expectedReturn, $amount);
    }

    public function getBaseProductAmountValueDataProvider(): array
    {
        return [
            ['', 0.0],
            ['1.0', 1.0],
            ['0.5', 0.5],
            ['3.75', 3.75],
            ['40.5', 40.5]
        ];
    }


    /**
     * @dataProvider getBaseProductPackagingValueDataProvider
     */
    public function testGetBaseProductPackagingValue(string $rawValue, string $expectedReturn): void
    {
        $amount = $this->wholesalerBJsonNormalizer->getBaseProductPackagingValue($rawValue);

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
        $amount = $this->wholesalerBJsonNormalizer->getBaseProductQuantityValue($rawValue);

        $this->assertEquals($expectedReturn, $amount);
    }

    public function getBaseProductQuantityValueDataProvider(): array
    {
        return [
            ['', 0],
            ['0', 0],
            ['1', 1],
            ['20', 20]
        ];
    }

    /**
     * @dataProvider getProductPackagingValueDataProvider
     */
    public function testGetProductPackagingValue(string $rawValue, string $expectedReturn): void
    {
        $amount = $this->wholesalerBJsonNormalizer->getPackagingValue($rawValue);

        $this->assertEquals($expectedReturn, $amount);
    }

    public function getProductPackagingValueDataProvider(): array
    {
        return [
            ['', ''],
            ['case', 'CA'],
            ['bottle', 'BO'],
            ['BOTTLE', 'BO'],
            ['box', 'BX'],
            ['abc', '']
        ];
    }
}

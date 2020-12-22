<?php

declare(strict_types=1);

namespace unit\kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\ProductFetcher;
use kollex\Dataprovider\Assortment\DataProviderB;
use kollex\Dataprovider\Assortment\Product\Product;
use PHPUnit\Framework\TestCase;

class DataProviderBTest extends TestCase
{
    /**
     * @var ProductFetcher|\PHPUnit\Framework\MockObject\MockObject
     */
    private $productFetcherMock;

    private DataProviderB $dataProviderB;

    protected function setUp(): void
    {
        $this->productFetcherMock = $this->createMock(ProductFetcher::class);

        $this->dataProviderB = new DataProviderB($this->productFetcherMock);
    }

    public function testNoProductReturned()
    {
        $this->productFetcherMock
            ->method('getProduct')
            ->willReturn(null);

        $returnedProducts = $this->dataProviderB->getProducts();

        $this->assertCount(0, $returnedProducts);
    }

    public function testCanGetOneProduct()
    {
        $this->productFetcherMock
            ->method('getProduct')
            ->willReturnOnConsecutiveCalls(
                $this->createMock(Product::class),
                null
            );

        $returnedProducts = $this->dataProviderB->getProducts();

        $this->assertCount(1, $returnedProducts);
        $this->assertInstanceOf(Product::class, $returnedProducts[0]);
    }

    public function testCanGetMultipleProducts()
    {
        $this->productFetcherMock
            ->method('getProduct')
            ->willReturnOnConsecutiveCalls(
                $this->createMock(Product::class),
                $this->createMock(Product::class),
                null
            );

        $returnedProducts = $this->dataProviderB->getProducts();

        $this->assertCount(2, $returnedProducts);
        $this->assertInstanceOf(Product::class, $returnedProducts[0]);
        $this->assertInstanceOf(Product::class, $returnedProducts[1]);
    }
}

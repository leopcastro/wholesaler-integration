<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

class DataProviderA implements DataProvider
{
    private ProductFetcher $productFetcher;

    public function __construct(ProductFetcher $productFetcher)
    {
        $this->productFetcher = $productFetcher;
    }

    public function getProducts(): array
    {
        $products = [];

        while (($product = $this->productFetcher->getProduct()) !== null) {
            $products[] = $product;
        }

        return $products;
    }
}

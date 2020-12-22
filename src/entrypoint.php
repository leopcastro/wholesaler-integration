<?php

declare(strict_types=1);

use kollex\Dataprovider\Assortment\CsvReader;
use kollex\Dataprovider\Assortment\DataProviderA;
use kollex\Dataprovider\Assortment\DataProviderB;
use kollex\Dataprovider\Assortment\FileNotFound;
use kollex\Dataprovider\Assortment\JsonFileDataReader;
use kollex\Dataprovider\Assortment\Product\Product;
use kollex\Dataprovider\Assortment\ProductArrayTransformer;
use kollex\Dataprovider\Assortment\WholesalerACsvFetcher;
use kollex\Dataprovider\Assortment\WholesalerACsvNormalizer;
use kollex\Dataprovider\Assortment\WholesalerBJsonFetcher;
use kollex\Dataprovider\Assortment\WholesalerBJsonNormalizer;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * @return Product[]
 * @throws FileNotFound
 */
function getProductsFromProviderA(): array
{
    $dataProviderA = new DataProviderA(
        new WholesalerACsvFetcher(
            new WholesalerACsvNormalizer(),
            new CsvReader(__DIR__ . '/../data/wholesaler_a.csv')
        )
    );

    return $dataProviderA->getProducts();
}

/**
 * @return Product[]
 * @throws FileNotFound
 */
function getProductsFromProviderB(): array
{
    $dataProviderB = new DataProviderB(
        new WholesalerBJsonFetcher(
            new WholesalerBJsonNormalizer(),
            new JsonFileDataReader(__DIR__ . '/../data/wholesaler_b.json')
        )
    );

    return $dataProviderB->getProducts();
}

function serializeProductsToJson($products): string
{
    $productNormalizer = new ProductArrayTransformer();

    $normalizedProducts = array_map(function (Product $product) use ($productNormalizer) {
        return $productNormalizer->transform($product);
    }, $products);

    return json_encode($normalizedProducts);
}

echo "\nProducts from Provider A\n\n";
echo serializeProductsToJson(getProductsFromProviderA());
echo "\n\nProducts from Provider B\n\n";
echo serializeProductsToJson(getProductsFromProviderB());
echo "\n\n";

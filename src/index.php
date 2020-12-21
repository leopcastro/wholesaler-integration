<?php

declare(strict_types=1);

use kollex\Dataprovider\Assortment\CsvReader;
use kollex\Dataprovider\Assortment\DataProviderA;
use kollex\Dataprovider\Assortment\WholesalerACsvFetcher;
use kollex\Dataprovider\Assortment\WholesalerACsvNormalizer;

require_once __DIR__ . '/../vendor/autoload.php';

$dataProviderA = new DataProviderA(
    new WholesalerACsvFetcher(
        new WholesalerACsvNormalizer(),
        new CsvReader(__DIR__ . '/../data/wholesaler_a.csv')
    )
);

$products = $dataProviderA->getProducts();

print_r($products);

<?php

declare(strict_types=1);

use kollex\Dataprovider\Assortment\CsvReader;
use kollex\Dataprovider\Assortment\DataProviderA;
use kollex\Dataprovider\Assortment\DataProviderB;
use kollex\Dataprovider\Assortment\JsonFileDataReader;
use kollex\Dataprovider\Assortment\WholesalerACsvFetcher;
use kollex\Dataprovider\Assortment\WholesalerACsvNormalizer;
use kollex\Dataprovider\Assortment\WholesalerBJsonFetcher;
use kollex\Dataprovider\Assortment\WholesalerBJsonNormalizer;

require_once __DIR__ . '/../vendor/autoload.php';

//$dataProviderA = new DataProviderA(
//    new WholesalerACsvFetcher(
//        new WholesalerACsvNormalizer(),
//        new CsvReader(__DIR__ . '/../data/wholesaler_a.csv')
//    )
//);
//
//$products = $dataProviderA->getProducts();

$dataProviderB = new DataProviderB(
    new WholesalerBJsonFetcher(
        new WholesalerBJsonNormalizer(),
        new JsonFileDataReader(__DIR__ . '/../data/wholesaler_b.json')
    )
);

$products = $dataProviderB->getProducts();

print_r($products);

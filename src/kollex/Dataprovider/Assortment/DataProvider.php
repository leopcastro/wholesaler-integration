<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\Product\Product;

interface DataProvider
{
    /**
     * @return Product[]
     */
    public function getProducts(): array;
}

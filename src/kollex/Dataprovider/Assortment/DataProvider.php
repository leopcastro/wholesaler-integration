<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

interface DataProvider
{
    /**
     * @return Product[]
     */
    public function getProducts(): array;
}

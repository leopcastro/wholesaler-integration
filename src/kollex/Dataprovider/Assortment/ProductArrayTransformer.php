<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\Product\Product;

class ProductArrayTransformer
{
    public function transform(Product $product): array
    {
        $productNormalized['id'] = $product->getId();

        if ($product->getGtin() !== '') {
            $productNormalized['gtin'] = $product->getGtin();
        }

        $productNormalized['manufacturer'] = $product->getManufacturer();
        $productNormalized['name'] = $product->getName();
        $productNormalized['packaging'] = $product->getPackaging()->getType();
        $productNormalized['baseProductPackaging'] = $product->getBaseProductPackaging()->getType();
        $productNormalized['baseProductUnit'] = $product->getBaseProductUnit()->getType();
        $productNormalized['baseProductAmount'] = $product->getBaseProductAmount();
        $productNormalized['baseProductQuantity'] = $product->getBaseProductQuantity();

        return $productNormalized;
    }
}

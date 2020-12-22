<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\Product\BaseProductPackaging;
use kollex\Dataprovider\Assortment\Product\Packaging;

class WholesalerBJsonNormalizer
{
    public function getBaseProductAmountValue(string $rawValue): float
    {
        $numericalValue = str_replace(',', '.', $rawValue);

        return floatval($numericalValue);
    }

    public function getBaseProductPackagingValue(string $rawValue): string
    {
        if (preg_match('/bottle/', $rawValue)) {
            return BaseProductPackaging::BOTTLE;
        }

        if (preg_match('/can/', $rawValue)) {
            return BaseProductPackaging::CAN;
        }

        return '';
    }

    public function getBaseProductQuantityValue(string $rawValue): int
    {
        return intval($rawValue);
    }

    public function getPackagingValue(string $rawValue): string
    {
        if (preg_match('/case/', $rawValue)) {
            return Packaging::CASE;
        }

        if (preg_match('/box/', $rawValue)) {
            return Packaging::BOX;
        }

        if (preg_match('/bottle/i', $rawValue)) {
            return Packaging::BOTTLE;
        }

        return '';
    }
}

<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\Product\BaseProductPackaging;
use kollex\Dataprovider\Assortment\Product\BaseProductUnit;
use kollex\Dataprovider\Assortment\Product\Packaging;

class WholesalerACsvNormalizer
{
    public function getBaseProductAmountValue(string $rawValue): float
    {
        $numericalValue = preg_replace('/[^0-9.]+/', '', $rawValue);

        return floatval($numericalValue);
    }

    public function getBaseProductUnitValue(string $rawValue): string
    {
        if (preg_match('/l/', $rawValue)) {
            return BaseProductUnit::LITERS;
        }

        // TODO implement GRAMS when there is example of the format used in CSV

        return '';
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
        if ($rawValue === 'single') {
            return 1;
        }

        $numericalValue = preg_replace('/[^0-9]+/', '', $rawValue);

        return intval($numericalValue);
    }

    public function getPackagingValue(string $rawValue): string
    {
        if (preg_match('/case/', $rawValue)) {
            return Packaging::CASE;
        }

        if (preg_match('/box/', $rawValue)) {
            return Packaging::BOX;
        }

        if (preg_match('/single/', $rawValue)) {
            return Packaging::BOTTLE;
        }

        return '';
    }
}

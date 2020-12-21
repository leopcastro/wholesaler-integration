<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\Product\BaseProductPackaging;
use kollex\Dataprovider\Assortment\Product\BaseProductUnit;
use kollex\Dataprovider\Assortment\Product\Packaging;
use kollex\Dataprovider\Assortment\Product\Product;
use kollex\Dataprovider\Assortment\Product\WholesalerProduct;

class WholesalerACsvFetcher implements ProductFetcher
{
    private WholesalerACsvNormalizer $wholesalerACsvNormalizer;

    private CsvReader $csvReader;

    public function __construct(WholesalerACsvNormalizer $wholesalerACsvNormalizer, CsvReader $csvReader)
    {
        $this->wholesalerACsvNormalizer = $wholesalerACsvNormalizer;
        $this->csvReader = $csvReader;
    }

    public function getProduct(): ?Product
    {
        $rowData = $this->csvReader->getData();

        if (!$rowData) {
            return null;
        }

        $id = $rowData[0];
        $manufacturer = $rowData[2];
        $name = $rowData[3];
        $packaging = new Packaging($this->wholesalerACsvNormalizer->getPackagingValue($rowData[5]));
        $baseProductPackaging = new BaseProductPackaging(
            $this->wholesalerACsvNormalizer->getBaseProductPackagingValue($rowData[7])
        );
        $baseProductUnit = new BaseProductUnit($this->wholesalerACsvNormalizer->getBaseProductUnitValue($rowData[8]));
        $baseProductAmount = $this->wholesalerACsvNormalizer->getBaseProductAmountValue($rowData[8]);
        $baseProductQuantity = $this->wholesalerACsvNormalizer->getBaseProductQuantityValue($rowData[5]);

        $product = new WholesalerProduct(
            $id,
            $manufacturer,
            $name,
            $packaging,
            $baseProductPackaging,
            $baseProductUnit,
            $baseProductAmount,
            $baseProductQuantity
        );

        $product->setGtin($rowData[1]);

        return $product;
    }
}

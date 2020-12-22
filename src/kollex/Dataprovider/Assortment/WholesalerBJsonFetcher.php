<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

use kollex\Dataprovider\Assortment\Product\BaseProductPackaging;
use kollex\Dataprovider\Assortment\Product\BaseProductUnit;
use kollex\Dataprovider\Assortment\Product\Packaging;
use kollex\Dataprovider\Assortment\Product\Product;
use kollex\Dataprovider\Assortment\Product\WholesalerProduct;

class WholesalerBJsonFetcher implements ProductFetcher
{
    private JsonFileDataReader $jsonReader;

    private WholesalerBJsonNormalizer $wholesalerBJsonNormalizer;

    public function __construct(WholesalerBJsonNormalizer $wholesalerBJsonNormalizer, JsonFileDataReader $csvReader)
    {
        $this->jsonReader = $csvReader;
        $this->wholesalerBJsonNormalizer = $wholesalerBJsonNormalizer;
    }

    public function getProduct(): ?Product
    {
        $rowData = $this->jsonReader->getData();

        if (!$rowData) {
            return null;
        }

        $id = $rowData['PRODUCT_IDENTIFIER'];
        $manufacturer = $rowData['BRAND'];
        $name = $rowData['NAME'];
        $packaging = new Packaging($this->wholesalerBJsonNormalizer->getPackagingValue($rowData['PACKAGE']));
        $baseProductPackaging = new BaseProductPackaging(
            $this->wholesalerBJsonNormalizer->getBaseProductPackagingValue($rowData['VESSEL'])
        );
        $baseProductUnit = new BaseProductUnit(BaseProductUnit::LITERS);
        $baseProductAmount = $this->wholesalerBJsonNormalizer->getBaseProductAmountValue($rowData['LITERS_PER_BOTTLE']);
        $baseProductQuantity = $this->wholesalerBJsonNormalizer->getBaseProductQuantityValue('BOTTLE_AMOUNT');

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

        $product->setGtin($rowData['EAN_CODE_GTIN']);

        return $product;
    }
}

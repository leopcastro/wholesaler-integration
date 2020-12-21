<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment\Product;

class BaseProductUnit
{
    public const LITERS = 'LT';
    public const GRAMS = 'GR';

    private const VALID_TYPES = [self::LITERS, self::GRAMS];

    private string $type;

    public function __construct(string $type)
    {
        if (!in_array($type, self::VALID_TYPES)) {
            throw new InvalidType('Type must be one of ' . implode(', ', self::VALID_TYPES));
        }

        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}

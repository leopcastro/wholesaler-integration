<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment\Product;

class Packaging
{
    public const CASE = 'CA';
    public const BOX = 'BX';
    public const BOTTLE = 'BO';

    private const VALID_TYPES = [self::CASE, self::BOX, self::BOTTLE];

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

<?php

declare(strict_types=1);

namespace Union\Bundle\UnionBundle\Utils\Helper;

class MoneyHelper
{
    public static function toDecimal(int $price, int $divisor = 100): float
    {
        return $price / $divisor;
    }

    public static function toInteger(float $price, int $multiplier = 100): int
    {
        return (int) ($price * $multiplier);
    }
}

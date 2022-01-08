<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Number;

use AlexPeregrina\ValueObject\Domain\Enum\Enum;

class RoundingMode extends Enum
{
    const HALF_UP   = PHP_ROUND_HALF_UP;
    const HALF_DOWN = PHP_ROUND_HALF_DOWN;
    const HALF_EVEN = PHP_ROUND_HALF_EVEN;
    const HALF_ODD  = PHP_ROUND_HALF_ODD;
}
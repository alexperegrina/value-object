<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Geography;

use AlexPeregrina\ValueObject\Domain\Enum\Enum;

class DistanceUnit extends Enum
{
    const FOOT      = 'ft';
    const METER     = 'mt';
    const KILOMETER = 'km';
    const MILE      = 'mi';
}
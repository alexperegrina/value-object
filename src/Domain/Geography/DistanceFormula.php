<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Geography;

use AlexPeregrina\ValueObject\Domain\Enum\Enum;

class DistanceFormula extends Enum
{
    const FLAT      = 'flat';
    const HAVERSINE = 'haversine';
    const VINCENTY  = 'vincenty';
}
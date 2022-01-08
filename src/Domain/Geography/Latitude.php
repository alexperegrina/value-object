<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Geography;

use AlexPeregrina\ValueObject\Domain\Number\Real;
use League\Geotools\Coordinate\Coordinate as BaseCoordinate;

class Latitude extends Real
{
    public function __construct(float $value)
    {
        parent::__construct($value);
        $this->normalize();
    }

    protected function normalize(): void
    {
        // normalization process through Coordinate object
        $coordinate = new BaseCoordinate(array($this->value, 0));
        $latitude = (float)$coordinate->getLatitude();

        $this->value = $latitude;
    }
}
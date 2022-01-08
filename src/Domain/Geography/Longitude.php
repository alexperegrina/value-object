<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Geography;

use AlexPeregrina\ValueObject\Domain\Number\Real;
use League\Geotools\Coordinate\Coordinate as BaseCoordinate;

class Longitude extends Real
{
    public function __construct(protected float $value)
    {
        parent::__construct($value);
        $this->normalize();
    }

    protected function normalize(): void
    {
        // normalization process through Coordinate object
        $coordinate = new BaseCoordinate(array(0, $this->value));
        $latitude = (float)$coordinate->getLongitude();

        $this->value = $latitude;
    }
}
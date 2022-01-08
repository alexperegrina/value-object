<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Interfaces\Response\Dto;

use AlexPeregrina\Response\Interfaces\Dto\DtoResponse;
use AlexPeregrina\ValueObject\Domain\Geography\Coordinate;

class CoordinateDtoResponse implements DtoResponse
{
    private function __construct(
        private float $latitude,
        private float $longitude
    ) {}

    public static function make(Coordinate $coordinate)
    {
        return new self(
            $coordinate->latitude()->value(),
            $coordinate->longitude()->value()
        );
    }

    public function latitude(): float
    {
        return $this->latitude;
    }

    public function longitude(): float
    {
        return $this->longitude;
    }
}
<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Interfaces\Response\Dto;

use AlexPeregrina\Response\Interfaces\Dto\DtoResponse;
use AlexPeregrina\ValueObject\Domain\Geography\Street;

class StreetDtoResponse implements DtoResponse
{
    private function __construct(
        private string $name,
        private string $number
    ) {}

    public static function make(Street $street)
    {
        return new self(
            $street->name()->value(),
            $street->number()->value()
        );
    }

    public function name(): string
    {
        return $this->name;
    }

    public function number(): string
    {
        return $this->number;
    }
}
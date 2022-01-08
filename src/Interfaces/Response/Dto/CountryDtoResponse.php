<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Interfaces\Response\Dto;

use AlexPeregrina\Response\Interfaces\Dto\DtoResponse;
use AlexPeregrina\ValueObject\Domain\Geography\Country;

class CountryDtoResponse implements DtoResponse
{
    private function __construct(
        private string $name,
        private string $code
    ) {}

    public static function make(Country $country)
    {
        return new self(
            $country->name()->value(),
            $country->code()->value()
        );
    }

    public function name(): string
    {
        return $this->name;
    }

    public function code(): string
    {
        return $this->code;
    }
}
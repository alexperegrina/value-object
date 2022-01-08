<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Interfaces\Response\Dto;

use AlexPeregrina\Response\Interfaces\Dto\DtoResponse;
use AlexPeregrina\ValueObject\Domain\Geography\Address;

class AddressDtoResponse implements DtoResponse
{
    private function __construct(
        private StreetDtoResponse $street,
        private string $city,
        private string $province,
        private string $region,
        private CountryDtoResponse $country,
        private string $postalCode
    ) {}

    public static function make(Address $address)
    {
        return new self(
            StreetDtoResponse::make($address->street()),
            $address->city()->value(),
            $address->province()->value(),
            $address->region()->value(),
            CountryDtoResponse::make($address->country()),
            $address->postalCode()->value()
        );
    }

    public function street(): StreetDtoResponse
    {
        return $this->street;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function province(): string
    {
        return $this->province;
    }

    public function region(): string
    {
        return $this->region;
    }

    public function country(): CountryDtoResponse
    {
        return $this->country;
    }

    public function postalCode(): string
    {
        return $this->postalCode;
    }
}
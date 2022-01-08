<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Geography;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;
use AlexPeregrina\ValueObject\Domain\String\StringVO;

class Address extends AbstractValueObject
{
    public function __construct(
        private Street $street,
        private StringVO $city,
        private StringVO $province,
        private StringVO $region,
        private Country $country,
        private PostalCode $postalCode
    ) {}

    public function street(): Street
    {
        return $this->street;
    }

    public function city(): StringVO
    {
        return $this->city;
    }

    public function province(): StringVO
    {
        return $this->province;
    }

    public function region(): StringVO
    {
        return $this->region;
    }

    public function country(): Country
    {
        return $this->country;
    }

    public function postalCode(): PostalCode
    {
        return $this->postalCode;
    }

    protected function equalValues(AbstractValueObject|Address $object): bool
    {
        return $this->street()->equals($object->street()) &&
            $this->city()->equals($object->city()) &&
            $this->province()->equals($object->province()) &&
            $this->region()->equals($object->region()) &&
            $this->country()->equals($object->country()) &&
            $this->postalCode()->equals($object->postalCode());
    }
}
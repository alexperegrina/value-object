<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\User;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;
use AlexPeregrina\ValueObject\Domain\String\StringVO;

class Name extends AbstractValueObject
{
    public function __construct(
        protected StringVO $firstName,
        protected StringVO $middleName,
        protected StringVO $lastName,
    ) {}

    public function firstName(): StringVO
    {
        return $this->firstName;
    }

    public function middleName(): StringVO
    {
        return $this->middleName;
    }

    public function lastName(): StringVO
    {
        return $this->lastName;
    }

    public function fullName(): StringVO
    {
        return new StringVO($this->firstName->value().' '.$this->middleName->value().' '.$this->lastName->value());
    }

    protected function equalValues(AbstractValueObject|Name $object): bool
    {
        return $this->fullName()->equals($object->fullName());
    }
}
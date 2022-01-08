<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Geography;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;
use AlexPeregrina\ValueObject\Domain\String\StringVO;

class Street extends AbstractValueObject
{
    public function __construct(
        protected StringVO $name,
        protected StringVO $number,
    ) {}

    public function name(): StringVO
    {
        return $this->name;
    }

    public function number(): StringVO
    {
        return $this->number;
    }

    protected function equalValues(AbstractValueObject|Street $object): bool
    {
        return $this->name() === $object->name() &&
            $this->number() === $object->number();
    }
}
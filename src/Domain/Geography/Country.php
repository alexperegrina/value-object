<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Geography;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;
use AlexPeregrina\ValueObject\Domain\String\StringVO;

class Country extends AbstractValueObject
{
    public function __construct(
        private StringVO $name,
        protected CountryCode $code
    ) {
        $this->guard($code);
    }

    protected function guard(CountryCode $code): void
    {
//        if (false === is_string($code)) {
//            throw new InvalidNativeArgumentException($code, array('string'));
//        }
    }

    public function name(): StringVO
    {
        return $this->name;
    }

    public function code(): CountryCode
    {
        return $this->code;
    }

    protected function equalValues(AbstractValueObject|Country $object): bool
    {
        return $this->code()->value() === $object->code()->value();
    }
}
<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\String;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;
use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;

class StringVO extends AbstractValueObject
{
    public function __construct(protected string $value)
    {
        $this->guard($value);
    }

    protected function guard(string $value): void
    {
        if (false === is_string($value)) {
            throw new InvalidNativeArgumentException($value, array('string'));
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    protected function equalValues(AbstractValueObject|StringVO $object): bool
    {
        return $this->value() === $object->value();
    }
}
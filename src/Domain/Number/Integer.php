<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Number;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;
use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;

use function intval;

class Integer extends AbstractValueObject
{
    public function __construct(protected int $value)
    {
        $this->guard($value);
    }

    public static function fromFloat(float $value): self
    {
        return new self(intval($value));
    }

    protected function guard(float $value): void
    {
        $value = filter_var($value, FILTER_VALIDATE_INT);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int'));
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    protected function equalValues(AbstractValueObject|Integer $object): bool
    {
        return $this->value() === $object->value();
    }
}
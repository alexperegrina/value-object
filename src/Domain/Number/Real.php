<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Number;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;

use function abs;
use function filter_var;
use function round;

class Real extends AbstractValueObject
{
    public function __construct(protected float $value)
    {
        $this->guard($value);
    }

    protected function guard(float $value): void
    {
        $value = filter_var($value, FILTER_VALIDATE_FLOAT);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('float'));
        }

        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }

    protected function equalValues(AbstractValueObject|Real $object): bool
    {
        return $this->value() === $object->value();
    }

    public function toInteger(RoundingMode $rounding_mode = null)
    {
        if (null == $rounding_mode) {
            $rounding_mode = RoundingMode::HALF_UP;
        }

        $value = $this->value();
        $round = round($value, 0, $rounding_mode->getValue());
        return Integer::fromFloat($round);
    }

    public function toNatural(RoundingMode $rounding_mode = null): Natural
    {
        $integerValue = $this->toInteger($rounding_mode)->value();
        $naturalValue = abs($integerValue);
        return new Natural($naturalValue);
    }

    public function add(Real $quantity): self
    {
        return new self($this->value + $quantity->value());
    }
}
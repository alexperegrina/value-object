<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Number;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;

class Natural extends Integer
{
    public function __construct(protected int $value)
    {
        $this->guard($value);
        parent::__construct($value);
    }

    protected function guard(float $value): void
    {
        $options = array(
            'options' => array(
                'min_range' => 0
            )
        );

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int (>=0)'));
        }
    }
}
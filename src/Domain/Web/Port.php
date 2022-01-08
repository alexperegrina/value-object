<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;
use AlexPeregrina\ValueObject\Domain\Number\Natural;

class Port extends Natural
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
                'min_range' => 0,
                'max_range' => 65535
            )
        );

        $value = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new InvalidNativeArgumentException($value, array('int (>=0, <=65535)'));
        }
    }
}
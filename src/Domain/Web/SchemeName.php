<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;
use AlexPeregrina\ValueObject\Domain\String\StringVO;

class SchemeName extends StringVO
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guard($value);
    }

    protected function guard(string $value): void
    {
        if (0 === \preg_match('/^[a-z]([a-z0-9\+\.-]+)?$/i', $value)) {
            throw new InvalidNativeArgumentException($value, array('string (valid scheme name)'));
        }
    }
}
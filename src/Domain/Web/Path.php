<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;
use AlexPeregrina\ValueObject\Domain\String\StringVO;

class Path extends StringVO
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guard($value);
    }

    protected function guard(string $value): void
    {
        $filteredValue = parse_url($value, PHP_URL_PATH);

        if (null === $filteredValue || strlen($filteredValue) != strlen($value)) {
            throw new InvalidNativeArgumentException($value, array('string (valid url path)'));
        }
    }
}
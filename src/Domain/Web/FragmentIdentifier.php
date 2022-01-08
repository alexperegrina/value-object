<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;
use AlexPeregrina\ValueObject\Domain\String\StringVO;

class FragmentIdentifier extends StringVO
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guard($value);
    }

    protected function guard(string $value): void
    {
        if (0 === \preg_match('/^#[?%!$&\'()*+,;=a-zA-Z0-9-._~:@\/]*$/', $value)) {
            throw new InvalidNativeArgumentException($value, array('string (valid fragment identifier)'));
        }
    }
}
<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;
use AlexPeregrina\ValueObject\Domain\String\StringVO;

class Email extends StringVO
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guard($value);
    }

    protected function guard(string $value): void
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_EMAIL);

        if ($filteredValue === false) {
            throw new InvalidNativeArgumentException($value, array('string (valid email address)'));
        }
    }

    public function local(): StringVO
    {
        $parts = explode('@', $this->value());
        return new StringVO($parts[0]);
    }

    public function domain(): Domain
    {
        $parts = \explode('@', $this->value());
        $domain = \trim($parts[1], '[]');

        return Domain::specifyType($domain);
    }
}
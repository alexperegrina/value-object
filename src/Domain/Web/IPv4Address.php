<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;

class IPv4Address extends IPAddress
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guard($value);
    }

    protected function guard(string $value): void
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

        if ($filteredValue === false) {
            throw new InvalidNativeArgumentException($value, array('string (valid ipv4 address)'));
        }
    }
}
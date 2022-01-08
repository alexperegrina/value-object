<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidNativeArgumentException;

class IPAddress extends Domain
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guard($value);
    }

    protected function guard(string $value): void
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_IP);

        if ($filteredValue === false) {
            throw new InvalidNativeArgumentException($value, array('string (valid ip address)'));
        }
    }

    public function version(): IPAddressVersion
    {
        $isIPv4 = filter_var($this->value(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

        if (false !== $isIPv4) {
            return IPAddressVersion::IPV4();
        }

        return IPAddressVersion::IPV6();
    }
}
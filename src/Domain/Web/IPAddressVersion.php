<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\Enum\Enum;

class IPAddressVersion extends Enum
{
    const IPV4 = 'IPv4';
    const IPV6 = 'IPv6';
}
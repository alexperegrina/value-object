<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\String\StringVO;

abstract class Domain extends StringVO
{
    public static function specifyType($domain): Hostname|IPAddress
    {
        if (false !== filter_var($domain, FILTER_VALIDATE_IP)) {
            return new IPAddress($domain);
        }

        return new Hostname($domain);
    }
}
<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\User;

use AlexPeregrina\ValueObject\Domain\Enum\Enum;

class Gender extends Enum
{
    const MALE   = 'male';
    const FEMALE = 'female';
    const OTHER  = 'other';
}
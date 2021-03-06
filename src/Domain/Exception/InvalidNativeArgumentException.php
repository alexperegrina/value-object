<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Exception;

use InvalidArgumentException;

class InvalidNativeArgumentException extends InvalidArgumentException
{
    public function __construct($value, array $allowed_types)
    {
        $message = sprintf('Argument "%s" is invalid. Allowed types for argument are "%s".', $value, implode(', ', $allowed_types));
        parent::__construct($message);
    }
}
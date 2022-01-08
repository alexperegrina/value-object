<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Exception;

use Exception;

class InvalidUuidException extends Exception
{
    private const CODE = 444;

    protected function __construct($message = "")
    {
        parent::__construct($message, self::CODE);
    }

    public static function make(string $uuid): self
    {
        $msg = "Invalid Uuid: $uuid";
        return new self($msg);
    }
}
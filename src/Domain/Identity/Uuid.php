<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Identity;

use AlexPeregrina\ValueObject\Domain\Exception\InvalidUuidException;
use AlexPeregrina\ValueObject\Domain\String\StringVO;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid extends StringVO
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->guardUuid($value);
    }

    public static function uuid4(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    /**
     * @throws InvalidUuidException
     */
    private function guardUuid(string $value): void
    {
        if (!RamseyUuid::isValid($value)) {
            throw InvalidUuidException::make($value);
        }
    }
}
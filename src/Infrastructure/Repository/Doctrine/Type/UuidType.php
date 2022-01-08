<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Infrastructure\Repository\Doctrine\Type;

use AlexPeregrina\ValueObject\Domain\Identity\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class UuidType extends GuidType
{
    public function getName()
    {
        return Uuid::class;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return new Uuid($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return $value->value();
    }
}
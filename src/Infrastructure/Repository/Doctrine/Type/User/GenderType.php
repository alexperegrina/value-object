<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Infrastructure\Repository\Doctrine\Type\User;

use AlexPeregrina\ValueObject\Domain\User\Gender;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class GenderType extends StringType
{
    public function getName(): string
    {
        return 'Gender';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return Gender::byName($value);
    }

    /**
     * @param Gender|null $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return $value->value();
    }
}
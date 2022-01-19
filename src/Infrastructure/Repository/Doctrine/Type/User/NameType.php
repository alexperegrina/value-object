<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Infrastructure\Repository\Doctrine\Type\User;

use AlexPeregrina\ValueObject\Domain\String\StringVO;
use AlexPeregrina\ValueObject\Domain\User\Name;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

class NameType extends JsonType
{
    public function getName(): string
    {
        return 'Name';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        $decode = json_decode($value, true);

        return new Name(
            new StringVO($decode['firstName']),
            $decode['middleName'] ? new StringVO($decode['middleName']) : null,
            $decode['lastName'] ? new StringVO($decode['lastName']) : null
        );
    }

    /**
     * @param Name|null $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return json_encode([
            'firstName' => $value->firstName()->value(),
            'middleName' => $value->middleName()->value(),
            'lastName' => $value->lastName()->value(),
       ]);
    }
}
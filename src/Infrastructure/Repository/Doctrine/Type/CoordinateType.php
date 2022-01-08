<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Infrastructure\Repository\Doctrine\Type;

use AlexPeregrina\ValueObject\Domain\Geography\Coordinate;
use AlexPeregrina\ValueObject\Domain\Geography\Latitude;
use AlexPeregrina\ValueObject\Domain\Geography\Longitude;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

class CoordinateType extends JsonType
{
    public function getName()
    {
        return Coordinate::class;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        $decode = json_decode($value, true);

        return new Coordinate(
            new Latitude((float)$decode['latitude']),
            new Longitude((float)$decode['longitude'])
        );
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Coordinate */
        if (null === $value) {
            return null;
        }

        return json_encode([
            'latitude' => $value->latitude()->value(),
            'longitude' => $value->longitude()->value()
        ]);
    }
}
<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Infrastructure\Repository\Doctrine\Type;

use AlexPeregrina\ValueObject\Domain\Geography\Address;
use AlexPeregrina\ValueObject\Domain\Geography\Country;
use AlexPeregrina\ValueObject\Domain\Geography\CountryCode;
use AlexPeregrina\ValueObject\Domain\Geography\PostalCode;
use AlexPeregrina\ValueObject\Domain\Geography\Street;
use AlexPeregrina\ValueObject\Domain\String\StringVO;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

class AddressType extends JsonType
{
    public function getName()
    {
        return Address::class;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        $decode = json_decode($value, true);

        return new Address(
            new Street(
                new StringVO($decode['street']['name']),
                new StringVO($decode['street']['number']),
            ),
            new StringVO($decode['city']),
            new StringVO($decode['province']),
            new StringVO($decode['region']),
            new Country(
                new StringVO($decode['country']['name']),
                CountryCode::byValue($decode['country']['code'])
            ),
            new PostalCode($decode['postalCode'])
        );
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var $value Address */

        if (null === $value) {
            return null;
        }

        return json_encode([
            'street' => [
                'name' => $value->street()->name()->value(),
                'number' => $value->street()->number()->value(),
            ],
            'city' => $value->city()->value(),
            'province' => $value->province()->value(),
            'region' => $value->region()->value(),
            'country' => [
                'name' => $value->country()->name()->value(),
                'code' => $value->country()->code()->value(),
            ],
            'postalCode' => $value->postalCode()->value()
        ]);
    }
}
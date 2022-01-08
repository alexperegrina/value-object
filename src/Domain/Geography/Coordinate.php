<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Geography;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;
use AlexPeregrina\ValueObject\Domain\Number\Real;
use AlexPeregrina\ValueObject\Domain\String\StringVO;
use League\Geotools\Coordinate\Coordinate as BaseCoordinate;
use League\Geotools\Coordinate\Ellipsoid as BaseEllipsoid;
use League\Geotools\Convert\Convert;
use League\Geotools\Distance\Distance;

class Coordinate extends AbstractValueObject
{
    public function __construct(
        private Latitude $latitude,
        private Longitude $longitude,
        private ?Ellipsoid $ellipsoid = null
    ) {
        if ($ellipsoid === null) {
            $this->ellipsoid = Ellipsoid::WGS84();
        }
    }

    public static function makeByValues(float $latitude, float $longitude): self
    {
        return new self(new Latitude($latitude), new Longitude($longitude));
    }

    public function latitude(): Latitude
    {
        return $this->latitude;
    }

    public function longitude(): Longitude
    {
        return $this->longitude;
    }

    public function ellipsoid(): ?Ellipsoid
    {
        return $this->ellipsoid;
    }

    /**
     * Returns a degrees/minutes/seconds representation of the coordinate
     */
    public function toDegreesMinutesSeconds(): StringVO
    {
        $coordinate = self::getBaseCoordinate($this);
        $convert = new Convert($coordinate);
        $dms = $convert->toDegreesMinutesSeconds();

        return new StringVO($dms);
    }

    /**
     * Returns a decimal minutes representation of the coordinate
     */
    public function toDecimalMinutes(): StringVO
    {
        $coordinate = self::getBaseCoordinate($this);
        $convert = new Convert($coordinate);
        $dm = $convert->toDecimalMinutes();

        return new StringVO($dm);
    }

    /**
     * Returns a Universal Transverse Mercator projection representation of the coordinate in meters
     */
    public function toUniversalTransverseMercator(): StringVO
    {
        $coordinate = self::getBaseCoordinate($this);
        $convert = new Convert($coordinate);
        $utm = $convert->toUniversalTransverseMercator();

        return new StringVO($utm);
    }

    /**
     * Calculates the distance between two Coordinate objects
     */
    public function distanceFrom(Coordinate $coordinate, DistanceUnit $unit = null, DistanceFormula $formula = null): Real
    {
        if (null === $unit) {
            $unit = DistanceUnit::METER();
        }

        if (null === $formula) {
            $formula = DistanceFormula::FLAT();
        }

        $baseThis = self::getBaseCoordinate($this);
        $baseCoordinate = self::getBaseCoordinate($coordinate);

        $distance = new Distance();
        $distance
            ->setFrom($baseThis)
            ->setTo($baseCoordinate)
            ->in($unit->getValue());

        $value = \call_user_func(array($distance, $formula->getValue()));

        return new Real($value);
    }

    protected function equalValues(AbstractValueObject|Coordinate $object): bool
    {
        return $this->latitude()->equals($object->latitude()) &&
            $this->longitude()->equals($object->longitude()) &&
            $this->ellipsoid()->equals($object->ellipsoid());
    }

    protected static function getBaseCoordinate(self $coordinate): BaseCoordinate
    {
        $latitude = $coordinate->latitude()->value();
        $longitude = $coordinate->longitude()->value();
        $ellipsoid = BaseEllipsoid::createFromName($coordinate->ellipsoid()->value());
        return new BaseCoordinate(array($latitude, $longitude), $ellipsoid);
    }
}
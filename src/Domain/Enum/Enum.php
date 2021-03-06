<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Enum;

use MabeEnum\Enum as BaseEnum;
use Serializable;

abstract class Enum extends BaseEnum implements Serializable
{
    public function value(): null|bool|int|float|string|array
    {
        return $this->getValue();
    }

    public function equals(self $object): bool
    {
        return self::classEquals($this, $object) && $this->equalValues($object);
    }

    protected function equalValues(self $object): bool
    {
        return $this->getValue() === $object->getValue();
    }

    public static function classEquals(object $object_a, object $object_b): bool
    {
        return get_class($object_a) === get_class($object_b);
    }

    public static function getClassAsString(object $object): string
    {
        return get_class($object);
    }

    public function serialize()
    {
//        return serialize($this->value());
    }

    public function unserialize($data)
    {
//        static::byValue($data);
    }
}
<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Money;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;
use AlexPeregrina\ValueObject\Domain\Number\Real;

class Money extends AbstractValueObject
{
    public function __construct(private Real $amount, private CurrencyCode $currency)
    {}

    public function amount(): Real
    {
        return $this->amount;
    }

    public function currency(): CurrencyCode
    {
        return $this->currency;
    }

    public function add(Real $quantity): self
    {
        $amount = $this->amount->add($quantity);
        return new self($amount, $this->currency);
    }

    protected function equalValues(AbstractValueObject|Money $object): bool
    {
        return $this->amount->equals($object->amount()) && $this->currency->equals($object->currency());
    }
}
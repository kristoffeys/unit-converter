<?php


namespace App\Unit\Temperature;


use App\Unit\AbstractNativeUnit;
use App\Unit\AbstractUnit;
use App\Unit\UnitInterface;

class Kelvin extends AbstractUnit
{
    public static function getName(): string
    {
        return 'K';
    }

    public static function fromNativeUnit(float $value): UnitInterface
    {
        return new self($value + 273.15);
    }

    public function toNativeUnit(): AbstractNativeUnit
    {
        return new Celsius($this->value - 273.15);
    }
}

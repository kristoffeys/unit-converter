<?php


namespace App\Unit\Distance;


use App\Unit\AbstractNativeUnit;
use App\Unit\AbstractUnit;
use App\Unit\UnitInterface;

class Kilometer extends AbstractUnit
{
    public static function getName(): string
    {
        return 'km';
    }

    public static function fromNativeUnit(float $value): UnitInterface
    {
        return new self($value / 1000);
    }

    public function toNativeUnit(): AbstractNativeUnit
    {
        return new Meter($this->value * 1000);
    }

}

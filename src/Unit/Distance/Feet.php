<?php


namespace App\Unit\Distance;


use App\Unit\AbstractNativeUnit;
use App\Unit\AbstractUnit;
use App\Unit\UnitInterface;

class Feet extends AbstractUnit
{

    public static function getName(): string
    {
        return 'ft';
    }

    public static function fromNativeUnit(float $value): UnitInterface
    {
        return new self($value / 0.3048);
    }

    public function toNativeUnit(): AbstractNativeUnit
    {
        return new Meter($this->value * 0.3048);
    }
}

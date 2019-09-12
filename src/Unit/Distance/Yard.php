<?php


namespace App\Unit\Distance;


use App\Unit\AbstractNativeUnit;
use App\Unit\AbstractUnit;
use App\Unit\UnitInterface;

class Yard extends AbstractUnit
{

    public static function getName(): string
    {
        return 'yd';
    }

    public static function fromNativeUnit(float $value): UnitInterface
    {
        return new self($value * 1.0936);
    }

    public function toNativeUnit(): AbstractNativeUnit
    {
        return new Meter($this->value / 1.0936);
    }
}

<?php


namespace App\Unit\Distance;


use App\Unit\AbstractNativeUnit;
use App\Unit\AbstractUnit;
use App\Unit\UnitInterface;

class Mile extends AbstractUnit
{

    public static function getName(): string
    {
        return 'mi';
    }

    public static function fromNativeUnit(float $value): UnitInterface
    {
        return new self($value * 0.000621371192);
    }

    public function toNativeUnit(): AbstractNativeUnit
    {
        return new Meter($this->value * 1609.344);
    }
}

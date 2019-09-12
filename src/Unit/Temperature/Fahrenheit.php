<?php


namespace App\Unit\Temperature;


use App\Unit\AbstractNativeUnit;
use App\Unit\AbstractUnit;
use App\Unit\UnitInterface;

class Fahrenheit extends AbstractUnit
{
    public static function getName(): string
    {
        return '°F';
    }

    public static function fromNativeUnit(float $value): UnitInterface
    {
        return new self($value * 1.8 + 32);
    }

    public function toNativeUnit(): AbstractNativeUnit
    {
        return new Celsius(($this->value - 32) * 5 / 9);
    }
}

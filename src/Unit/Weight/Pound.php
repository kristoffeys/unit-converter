<?php


namespace App\Unit\Weight;


use App\Unit\AbstractNativeUnit;
use App\Unit\AbstractUnit;
use App\Unit\UnitInterface;

class Pound extends AbstractUnit
{
    public static function getName(): string
    {
        return 'lb';
    }

    public static function fromNativeUnit(float $value): UnitInterface
    {
        return new self($value * 2.20462262185);
    }

    public function toNativeUnit(): AbstractNativeUnit
    {
        return new Kilogram($this->value * 0.45359237);
    }
}

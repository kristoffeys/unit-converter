<?php


namespace App\Unit\Weight;

use App\Unit\AbstractNativeUnit;
use App\Unit\AbstractUnit;
use App\Unit\UnitInterface;

class Stone extends AbstractUnit
{
    public static function getName(): string
    {
        return 'st';
    }

    public static function fromNativeUnit(float $value): UnitInterface
    {
        return new self($value * 0.157473);
    }

    public function toNativeUnit(): AbstractNativeUnit
    {
        return new Kilogram($this->value * 6.35029318);
    }
}

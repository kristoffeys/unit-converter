<?php


namespace App\Unit;


abstract class AbstractNativeUnit extends AbstractUnit
{
    public static function fromNativeUnit(float $value): UnitInterface
    {
        return new static($value);
    }

    public function toNativeUnit(): AbstractNativeUnit
    {
        return new static($this->value);
    }

}

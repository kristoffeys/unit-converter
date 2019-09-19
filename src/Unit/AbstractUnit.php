<?php


namespace App\Unit;


abstract class AbstractUnit implements UnitInterface
{
    abstract public static function getName(): string;

    abstract public static function fromNativeUnit(float $value): UnitInterface;

    abstract public function toNativeUnit(): AbstractNativeUnit;

    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function __toString()
    {
        return round($this->value, 2) . ' ' . static::getName();
    }
}

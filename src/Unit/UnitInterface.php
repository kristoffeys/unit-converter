<?php

namespace App\Unit;

interface UnitInterface
{
    public static function getName(): string;

    public function __construct($value);

    public static function fromNativeUnit(float $value): UnitInterface;

    public function toNativeUnit(): AbstractNativeUnit;

    public function getValue(): float;

    public function __toString();
}

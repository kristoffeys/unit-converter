<?php


namespace App\Unit\Weight;

use App\Unit\AbstractNativeUnit;

class Kilogram extends AbstractNativeUnit
{
    public static function getName(): string
    {
        return 'kg';
    }
}

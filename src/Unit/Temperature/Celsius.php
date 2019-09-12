<?php


namespace App\Unit\Temperature;


use App\Unit\AbstractNativeUnit;

class Celsius extends AbstractNativeUnit
{
    public static function getName(): string
    {
        return '°C';
    }
}

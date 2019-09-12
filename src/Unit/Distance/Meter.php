<?php


namespace App\Unit\Distance;


use App\Unit\AbstractNativeUnit;

class Meter extends AbstractNativeUnit
{

    public static function getName(): string
    {
        return 'm';
    }
}

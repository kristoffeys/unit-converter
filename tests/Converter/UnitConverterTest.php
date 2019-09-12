<?php


use App\Converter\UnitConverter;
use App\Exception\CannotConvertBetweenDifferentNamespacesException;
use App\Exception\FromUnitWasNotSetBeforeCallingToException;
use App\Exception\UnitDoesNotExistException;
use App\Unit\Distance\Meter;
use App\Unit\Weight\Kilogram;
use PHPUnit\Framework\TestCase;

class UnitConverterTest extends TestCase
{
    public function testFromUnexistingUnitThrowsException(): void
    {
        $this->expectException(UnitDoesNotExistException::class);
        $converter = new UnitConverter(1, [Kilogram::class]);
        $converter->from('unexisting');
    }

    public function testToUnexistingUnitThrowsException(): void
    {
        $this->expectException(UnitDoesNotExistException::class);
        $converter = new UnitConverter(1, [Kilogram::class]);
        $converter->from('kg')->to('unexisting');
    }

    public function testCallingToBeforeFromThrowsException(): void
    {
        $this->expectException(FromUnitWasNotSetBeforeCallingToException::class);
        $converter = new UnitConverter(1, [Kilogram::class]);
        $converter->to('kg');
    }

    public function testConversionBetweenDifferentNamespacesThrowsError(): void
    {
        $this->expectException(CannotConvertBetweenDifferentNamespacesException::class);
        $converter = new UnitConverter(1, [Kilogram::class, Meter::class]);
        $converter->from('kg')->to('m');
    }
}

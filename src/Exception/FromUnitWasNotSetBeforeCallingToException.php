<?php


namespace App\Exception;


use RuntimeException;

class FromUnitWasNotSetBeforeCallingToException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('The from() function should always be called before calling the to() function in the UnitConverter class.');
    }
}

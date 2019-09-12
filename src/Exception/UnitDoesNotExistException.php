<?php


namespace App\Exception;


use RuntimeException;

class UnitDoesNotExistException extends RuntimeException
{
    public function __construct($unitName)
    {
        parent::__construct('Unit with name ' . $unitName . ' does not exist in the application');
    }
}

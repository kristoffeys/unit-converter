<?php


namespace App\Exception;


use RuntimeException;

class CannotConvertBetweenDifferentNamespacesException extends RuntimeException
{
    public function __construct($from, $to)
    {
        parent::__construct('Unit "' . $from . '" cannot be converted to "' . $to . '" since it\'s not in the same namespace.');
    }
}

<?php


namespace App\Command;


class ConvertTemperatureCommand extends AbstractConvertCommand
{
    protected static $defaultName = 'unit-converter:temperature';

    protected function getUnitNamespace(): string
    {
        return '\App\Unit\Temperature';
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Converts a temperature unit')
            ->setHelp('This command allows you to convert a temperature unit between celsius, kelvin and fahrenheit')
        ;
    }
}

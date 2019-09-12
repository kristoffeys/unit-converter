<?php


namespace App\Command;

class ConvertWeightCommand extends AbstractConvertCommand
{
    protected static $defaultName = 'unit-converter:weight';

    protected function getUnitNamespace(): string
    {
        return '\App\Unit\Weight';
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Converts a weight unit')
            ->setHelp('This command allows you to convert a weight unit between kilogram, pound and stone')
        ;
    }
}

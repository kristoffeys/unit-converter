<?php


namespace App\Command;


class ConvertDistanceCommand extends AbstractConvertCommand
{
    protected static $defaultName = 'unit-converter:distance';

    protected function getUnitNamespace(): string
    {
        return '\App\Unit\Distance';
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Converts a distance unit')
            ->setHelp('This command allows you to convert a distance unit between meters, kilometers, yards, feet and miles.');
    }
}

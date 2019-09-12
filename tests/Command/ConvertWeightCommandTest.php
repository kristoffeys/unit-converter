<?php


use App\Command\ConvertWeightCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use App\Command\AbstractConvertCommand;

class ConvertWeightCommandTest extends TestCase
{
    /** @var CommandTester */
    private $commandTester;

    /** @var AbstractConvertCommand */
    private $command;

    public function setUp(): void
    {
        $application = new Application();
        $application->add(new ConvertWeightCommand());
        $this->command = $application->find('unit-converter:weight');
        $this->commandTester = new CommandTester($this->command);
    }

    public function testConvertKilogramToPound(): void
    {
        $this->commandTester->setInputs(['kg', 'lb', 1]);
        $this->commandTester->execute([]);
        $this->assertEquals('2.2 lb', $this->command->getResult());
    }

    public function testConvertPoundToKilogram(): void
    {
        $this->commandTester->setInputs(['lb', 'kg', 10]);
        $this->commandTester->execute([]);
        $this->assertEquals('4.54 kg', $this->command->getResult());
    }

    public function testConvertKilogramToStone(): void
    {
        $this->commandTester->setInputs(['kg', 'st', 1]);
        $this->commandTester->execute([]);
        $this->assertEquals('0.16 st', $this->command->getResult());
    }

    public function testConvertStoneToKilogram(): void
    {
        $this->commandTester->setInputs(['st', 'kg', 20]);
        $this->commandTester->execute([]);
        $this->assertEquals('127.01 kg', $this->command->getResult());
    }
}

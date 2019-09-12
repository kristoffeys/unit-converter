<?php


use App\Command\AbstractConvertCommand;
use App\Command\ConvertTemperatureCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ConvertTemperatureCommandTest extends TestCase
{
    /** @var CommandTester */
    private $commandTester;

    /** @var AbstractConvertCommand */
    private $command;

    public function setUp(): void
    {
        $application = new Application();
        $application->add(new ConvertTemperatureCommand());
        $this->command = $application->find('unit-converter:temperature');
        $this->commandTester = new CommandTester($this->command);
    }

    protected function tearDown(): void
    {
        $this->commandTester = null;
    }

    public function testConvertCelsiusToFahrenheit(): void
    {
        $this->commandTester->setInputs(['°C', '°F', 10]);
        $this->commandTester->execute([]);
        $this->assertEquals('50 °F', $this->command->getResult());
    }

    public function testConvertFahrenheitToCelsius(): void
    {
        $this->commandTester->setInputs(['°F', '°C', 20]);
        $this->commandTester->execute([]);
        $this->assertEquals('-6.67 °C', $this->command->getResult());
    }

    public function testConvertCelsiusToKelvin(): void
    {
        $this->commandTester->setInputs(['°C', 'K', 20]);
        $this->commandTester->execute([]);
        $this->assertEquals('293.15 K', $this->command->getResult());
    }

    public function testConvertKelvinToCelsius(): void
    {
        $this->commandTester->setInputs(['K', '°C', 20]);
        $this->commandTester->execute([]);
        $this->assertEquals('-253.15 °C', $this->command->getResult());
    }
}

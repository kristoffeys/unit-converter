<?php


use App\Command\AbstractConvertCommand;
use App\Command\ConvertDistanceCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ConvertDistanceCommandTest extends TestCase
{
    /** @var CommandTester */
    private $commandTester;

    /** @var AbstractConvertCommand */
    private $command;

    public function setUp(): void
    {
        $application = new Application();
        $application->add(new ConvertDistanceCommand());
        $this->command = $application->find('unit-converter:distance');
        $this->commandTester = new CommandTester($this->command);
    }

    protected function tearDown(): void
    {
        $this->commandTester = null;
    }

    public function testNonNumericValueThrowsError(): void
    {
        $this->commandTester->setInputs(['m', 'km', 'invalid']);
        $this->expectException(RuntimeException::class);
        $this->commandTester->execute([]);
    }

    public function testConvertMetersToKilometers(): void
    {
        $this->commandTester->setInputs(['m', 'km', 1000]);
        $this->commandTester->execute([]);
        $this->assertEquals('1 km', $this->command->getResult());
    }

    public function testConvertKilometersToMeters(): void
    {
        $this->commandTester->setInputs(['km', 'm', 10]);
        $this->commandTester->execute([]);
        $this->assertEquals('10000 m', $this->command->getResult());
    }

    public function testConvertMetersToYard(): void
    {
        $this->commandTester->setInputs(['m', 'yd', 10]);
        $this->commandTester->execute([]);
        $this->assertEquals('10.94 yd', $this->command->getResult());
    }

    public function testConvertYardToMeter(): void
    {
        $this->commandTester->setInputs(['yd', 'm', 1]);
        $this->commandTester->execute([]);
        $this->assertEquals('0.91 m', $this->command->getResult());
    }

    public function testConvertMeterToFeet(): void
    {
        $this->commandTester->setInputs(['m', 'ft', 1]);
        $this->commandTester->execute([]);
        $this->assertEquals('3.28 ft', $this->command->getResult());
    }

    public function testConvertFeetToMeter(): void
    {
        $this->commandTester->setInputs(['ft', 'm', 1]);
        $this->commandTester->execute([]);
        $this->assertEquals('0.3 m', $this->command->getResult());
    }

    public function testConvertMileToMeter(): void
    {
        $this->commandTester->setInputs(['mi', 'm', 1]);
        $this->commandTester->execute([]);
        $this->assertEquals('1609.34 m', $this->command->getResult());
    }

    public function testConvertMeterToMile(): void
    {
        $this->commandTester->setInputs(['m', 'mi', 1000]);
        $this->commandTester->execute([]);
        $this->assertEquals('0.62 mi', $this->command->getResult());
    }
}

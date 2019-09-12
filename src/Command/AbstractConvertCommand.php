<?php


namespace App\Command;


use App\Converter\UnitConverter;
use App\Unit\UnitInterface;
use Doctrine\Common\Collections\ArrayCollection;
use HaydenPierce\ClassFinder\ClassFinder;
use ReflectionClass;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use function array_diff;

abstract class AbstractConvertCommand extends Command
{
    /**
     * Returns the namespace in which all units are defined.
     */
    abstract protected function getUnitNamespace(): string;

    /** @var UnitInterface[] */
    protected $availableUnitClasses;

    /** @var string */
    private $result;

    public function __construct(string $name = null)
    {
        parent::__construct($name);
        $availableUnitClasses = new ArrayCollection(ClassFinder::getClassesInNamespace($this->getUnitNamespace()));

        //Make sure we only use classes that implement the UnitInterface
        $availableUnitClasses->filter(static function ($val) {
            return (new ReflectionClass($val))->implementsInterface(UnitInterface::class);
        });

        $this->availableUnitClasses = $availableUnitClasses->toArray();
    }

    protected function getUnits(): array
    {
        return array_map(static function ($unitClass) { return $unitClass::getName(); }, $this->availableUnitClasses);
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $helper = $this->getHelper('question');

        $question = new ChoiceQuestion('What unit do you want to convert from?', $this->getUnits());
        $from = $helper->ask($input,$output,$question);

        $question = new ChoiceQuestion('What unit do you want to convert to?', array_diff($this->getUnits(), [$from]));
        $to = $helper->ask($input,$output,$question);

        $question = new Question('What is the value you want to convert?', null);
        $question->setValidator(static function ($answer) {
            if (!is_numeric($answer)) {
                throw new RuntimeException('The value you want to convert should be numeric');
            }

            return $answer;
        });
        $number = $helper->ask($input, $output, $question);

        $this->result = (new UnitConverter($number, $this->availableUnitClasses))->from($from)->to($to);
        $output->writeln('Converted value: ' . $this->getResult());
    }

    public function getResult(): string {
        return $this->result;
    }
}

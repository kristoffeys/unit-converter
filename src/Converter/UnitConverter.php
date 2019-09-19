<?php


namespace App\Converter;


use App\Exception\CannotConvertBetweenDifferentNamespacesException;
use App\Exception\FromUnitWasNotSetBeforeCallingToException;
use App\Exception\UnitDoesNotExistException;
use App\Unit\UnitInterface;
use ReflectionClass;

class UnitConverter
{
    /** @var float */
    private $value;

    /** @var UnitInterface[] */
    private $availableUnitClasses;

    /** @var UnitInterface */
    private $from;

    public function __construct(float $value, array $availableUnitClasses)
    {
        $this->value = $value;
        $this->availableUnitClasses = $availableUnitClasses;
    }

    /**
     * Sets the Unit by name, from which we start the conversion.
     */
    public function from(string $name): self
    {
        $unitClass = $this->getUnitClassByName($name);
        $this->from = new $unitClass($this->value);
        return $this;
    }

    /**
     * Converts the from Unit to the unit given in the argument.
     */
    public function to(string $name): UnitInterface
    {
        if (null === $this->from) {
            throw new FromUnitWasNotSetBeforeCallingToException();
        }

        $unitClass = $this->getUnitClassByName($name);

        if (!$this->hasSameNamespace($unitClass, get_class($this->from))) {
            throw new CannotConvertBetweenDifferentNamespacesException(get_class($this->from), $unitClass);
        }

        return $unitClass::fromNativeUnit($this->from->toNativeUnit()->getValue());
    }

    /**
     * Gets the classname of the unit that is defined by the given name.
     */
    private function getUnitClassByName(string $name): string
    {
        foreach ($this->availableUnitClasses as $unitClass) {
            if ($unitClass::getName() === $name) {
                return $unitClass;
            }
        }

        throw new UnitDoesNotExistException($name);
    }

    /**
     * Checks whether all given classnames have the same namespace.
     */
    private function hasSameNamespace(string ...$classNames): bool
    {
        $namespace = (new ReflectionClass($classNames[0]))->getNamespaceName();
        unset($classNames[0]);

        foreach ($classNames as $className) {
            if ((new ReflectionClass($className))->getNamespaceName() !== $namespace) {
                return false;
            }
        }

        return true;
    }
}

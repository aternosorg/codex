<?php

namespace Aternos\Codex\Printer;

/**
 * Class ModifiablePrinter
 *
 * @package Aternos\Codex\Printer
 */
abstract class ModifiablePrinter extends Printer implements ModifiablePrinterInterface
{
    /**
     * @var array
     */
    protected $modificationClasses;

    /**
     * Set all modification classes replacing the current classes
     *
     * @param array $modificationClasses
     * @return $this
     */
    public function setModificationClasses(array $modificationClasses)
    {
        $this->modificationClasses = [];
        foreach ($modificationClasses as $modificationClass) {
            $this->addModificationClass($modificationClass);
        }

        return $this;
    }

    /**
     * Add a modification class
     *
     * @param string $modificationClass
     * @return $this
     */
    public function addModificationClass(string $modificationClass)
    {
        if (!is_subclass_of($modificationClass, ModificationInterface::class)) {
            throw new \InvalidArgumentException("Class " . $modificationClass . " does not implement " . ModificationInterface::class . ".");
        }

        $this->modificationClasses[] = $modificationClass;
        return $this;
    }

    /**
     * Run the set modifications for a string
     *
     * @param string $text
     * @return string
     */
    protected function runModifications(string $text)
    {
        foreach ($this->modificationClasses as $modificationClass) {
            /** @var ModificationInterface $modification */
            $modification = new $modificationClass();
            $text = $modification->modify($text);
        }

        return $text;
    }
}
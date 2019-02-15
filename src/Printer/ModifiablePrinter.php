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
    protected $modifications;

    /**
     * Set all modifications replacing the current modifications
     *
     * @param array $modifications
     * @return $this
     */
    public function setModifications(array $modifications)
    {
        $this->modifications = [];
        foreach ($modifications as $modification) {
            $this->addModification($modification);
        }

        return $this;
    }

    /**
     * Add a modification
     *
     * @param ModificationInterface $modification
     * @return $this
     */
    public function addModification(ModificationInterface $modification)
    {
        $this->modifications[] = $modification;
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
        foreach ($this->modifications as $modification) {
            /** @var ModificationInterface $modification */
            $text = $modification->modify($text);
        }

        return $text;
    }
}
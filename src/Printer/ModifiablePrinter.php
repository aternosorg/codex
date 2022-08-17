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
     * @var ModificationInterface[]
     */
    protected array $modifications = [];

    /**
     * Set all modifications replacing the current modifications
     *
     * @param ModificationInterface[] $modifications
     * @return $this
     */
    public function setModifications(array $modifications): static
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
    public function addModification(ModificationInterface $modification): static
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
    protected function runModifications(string $text): string
    {
        foreach ($this->modifications as $modification) {
            $text = $modification->modify($text);
        }

        return $text;
    }
}
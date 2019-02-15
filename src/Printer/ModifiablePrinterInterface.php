<?php

namespace Aternos\Codex\Printer;

/**
 * Interface ModifiablePrinterInterface
 *
 * @package Aternos\Codex\Printer
 */
interface ModifiablePrinterInterface extends PrinterInterface
{
    /**
     * Set all modifications replacing the current modifications
     *
     * @param array $modifications
     * @return $this
     */
    public function setModifications(array $modifications);

    /**
     * Add a modification
     *
     * @param ModificationInterface $modification
     * @return $this
     */
    public function addModification(ModificationInterface $modification);
}
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
     * Set all modification classes replacing the current classes
     *
     * @param array $modificationClasses
     * @return $this
     */
    public function setModificationClasses(array $modificationClasses);

    /**
     * Add a modification class
     *
     * @param string $modificationClass
     * @return $this
     */
    public function addModificationClass(string $modificationClass);
}
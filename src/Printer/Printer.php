<?php

namespace Aternos\Codex\Printer;

use Aternos\Codex\Log\LogInterface;

/**
 * Class Printer
 *
 * @package Aternos\Codex\Printer
 */
abstract class Printer implements PrinterInterface
{
    /**
     * @var LogInterface
     */
    protected $log;

    /**
     * Set the log
     *
     * @param LogInterface $log
     * @return $this
     */
    public function setLog(LogInterface $log)
    {
        $this->log = $log;
        return $this;
    }
}
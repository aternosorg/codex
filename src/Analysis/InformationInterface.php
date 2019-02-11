<?php

namespace Aternos\Codex\Analysis;

/**
 * Interface InformationInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface InformationInterface extends InsightInterface
{
    /**
     * Get the information label
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Set the information value
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);

    /**
     * Get the information value
     *
     * @return mixed
     */
    public function getValue();
}
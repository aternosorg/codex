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
    public function setValue(mixed $value): static;

    /**
     * Get the information value
     *
     * @return mixed
     */
    public function getValue(): mixed;
}
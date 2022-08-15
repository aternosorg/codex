<?php

namespace Aternos\Codex\Analysis;

/**
 * Class Information
 *
 * @package Aternos\Codex\Analysis
 */
abstract class Information extends Insight implements InformationInterface
{
    protected ?string $label = null;
    protected mixed $value = null;

    /**
     * Get the information label
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Set the information label
     *
     * @param string $label
     * @return $this
     */
    protected function setLabel(string $label): static
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Get the information value
     *
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * Set the information value
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue(mixed $value): static
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get a human-readable message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->getLabel() . ": " . $this->getValue();
    }

    /**
     * Check if the $insight object is equal with the current object
     *
     * @param InsightInterface $insight
     * @return bool
     */
    public function isEqual(InsightInterface $insight): bool
    {
        return $this->getLabel() === $insight->getLabel() && $this->getValue() === $insight->getValue();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            "label" => $this->getLabel(),
            "value" => $this->getValue()
        ]);
    }
}
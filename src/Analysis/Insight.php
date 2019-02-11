<?php

namespace Aternos\Codex\Analysis;

use Aternos\Codex\Log\EntryInterface;

/**
 * Class Insight
 *
 * @package Aternos\Codex\Analysis
 */
abstract class Insight implements InsightInterface
{
    /**
     * @var EntryInterface
     */
    protected $entry;

    /**
     * Set the related entry
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function setEntry(EntryInterface $entry)
    {
        $this->entry = $entry;
        return $this;
    }

    /**
     * Get the related entry
     *
     * @return EntryInterface
     */
    public function getEntry(): EntryInterface
    {
        return $this->entry;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}
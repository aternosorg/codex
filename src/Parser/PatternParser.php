<?php

namespace Aternos\Codex\Parser;

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\EntryInterface;
use Aternos\Codex\Log\Level;
use Aternos\Codex\Log\LevelInterface;
use Aternos\Codex\Log\Line;
use DateTime;
use DateTimeZone;
use InvalidArgumentException;

/**
 * Class PatternParser
 *
 * @package Aternos\Codex\Parser
 */
class PatternParser extends Parser
{
    /**
     * Match constants, see setMatches()
     */
    const string TIME = "time";
    const string LEVEL = "level";

    /**
     * @var class-string<EntryInterface>
     */
    protected string $entryClass = Entry::class;

    /**
     * @noinspection PhpDocFieldTypeMismatchInspection
     * @var class-string<LevelInterface>|LevelInterface
     */
    protected string $levelClass = Level::class;

    protected ?string $pattern = null;
    protected array $matches = [];
    protected ?string $timeFormat = null;
    protected ?DateTimeZone $timeZone = null;

    /**
     * Set the entry pattern
     *
     * Every line matching this pattern is defined as
     * new entry, all other lines are added to the
     * previous entry
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern(string $pattern): static
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * Get the entry pattern
     *
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * Set the array of match constants
     *
     * The position/key in the array defines
     * the position of the matching capturing
     * group in the $pattern
     *
     * @param array $matches
     * @return $this
     */
    public function setMatches(array $matches): static
    {
        $this->matches = $matches;
        return $this;
    }

    /**
     * Set the time format
     *
     * Time is parsed with the DateTime::createFromFormat() function,
     * see this for format information:
     *
     * http://php.net/manual/en/datetime.createfromformat.php
     *
     * @param string $timeFormat
     * @return $this
     */
    public function setTimeFormat(string $timeFormat): static
    {
        $this->timeFormat = $timeFormat;
        return $this;
    }

    /**
     * Set the time zone
     *
     * Optional, uses OS timezone otherwise
     *
     * @param DateTimeZone $timeZone
     * @return $this
     */
    public function setTimezone(DateTimeZone $timeZone): static
    {
        $this->timeZone = $timeZone;
        return $this;
    }

    /**
     * Parse a log from resource to Log object
     */
    public function parse(): void
    {
        foreach ($this->getLogContentAsArray() as $number => $lineString) {
            $line = new Line($number + 1, $lineString);
            $result = preg_match($this->pattern, $lineString, $matches);
            if ($result !== 1) {
                if (!isset($entry)) {
                    /** @var Entry $entry */
                    $entry = new $this->entryClass();
                    $this->log->addEntry($entry);
                }
                $entry->addLine($line);
                continue;
            }

            /** @var Entry $entry */
            $entry = new $this->entryClass();
            $this->log->addEntry($entry);
            foreach ($matches as $key => $match) {
                if ($key === 0) {
                    continue;
                }
                $matchKey = $key - 1;
                if (!isset($this->matches[$matchKey])) {
                    throw new InvalidArgumentException("More matches found in string than defined in PatternParser::setMatches().");
                }

                $this->parseEntryMatch($entry, $this->matches[$matchKey], $match);
            }
            $entry->addLine($line);
        }
    }

    /**
     * Parse an entry match
     *
     * Overwrite this function to add more different
     * match types and call the parent function (this function)
     * if you don't know the match type (default in a switch)
     *
     * @param Entry $entry
     * @param string $matchType One of the match constants
     * @param string $matchString
     */
    protected function parseEntryMatch(Entry $entry, string $matchType, string $matchString): void
    {
        switch ($matchType) {
            case static::TIME:
                $date = DateTime::createFromFormat($this->timeFormat, $matchString, $this->timeZone);
                if ($date) {
                    $entry->setTime($date->getTimestamp());
                }
                break;
            case static::LEVEL:
                $entry->setLevel($this->levelClass::fromString($matchString));
                break;
            default:
                throw new InvalidArgumentException("Match type '" . $matchType . "' is not defined.");
        }
    }
}
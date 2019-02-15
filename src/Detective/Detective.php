<?php

namespace Aternos\Codex\Detective;

use Aternos\Codex\Log\DetectableLogInterface;
use Aternos\Codex\Log\File\LogFileInterface;
use Aternos\Codex\Log\Log;
use Aternos\Codex\Log\LogInterface;

/**
 * Class Detective
 *
 * @package Aternos\Codex\Detective
 */
class Detective implements DetectiveInterface
{
    /**
     * @var array
     */
    protected $possibleLogClasses;

    /**
     * @var LogFileInterface
     */
    protected $logFile;

    /**
     * Set possible log classes
     *
     * Every class must implement DetectableLogInterface
     *
     * @param array $logClasses
     * @return $this
     */
    public function setPossibleLogClasses(array $logClasses)
    {
        $this->possibleLogClasses = [];
        foreach ($logClasses as $logClass) {
            $this->addPossibleLogClass($logClass);
        }

        return $this;
    }

    /**
     * Add a possible insight class
     *
     * The class must implement DetectableLogInterface
     *
     * @param string $logClass
     * @return $this
     */
    public function addPossibleLogClass(string $logClass)
    {
        if (!is_subclass_of($logClass, DetectableLogInterface::class)) {
            throw new \InvalidArgumentException("Class " . $logClass . " does not implement " . DetectableLogInterface::class . ".");
        }

        $this->possibleLogClasses[] = $logClass;
        return $this;
    }

    /**
     * Set the log file
     *
     * @param LogFileInterface $logFile
     * @return $this
     */
    public function setLogFile(LogFileInterface $logFile)
    {
        $this->logFile = $logFile;
        return $this;
    }

    /**
     * Detect a log type out of possible classes by using detector
     *
     * @return LogInterface
     */
    public function detect()
    {
        $detectionResults = [];
        foreach ($this->possibleLogClasses as $possibleLogClass) {
            /** @var DetectableLogInterface $possibleLogClass */
            $detectors = $possibleLogClass::getDetectors();
            foreach ($detectors as $detector) {
                if (!$detector instanceof DetectorInterface) {
                    throw new \InvalidArgumentException("Class " . get_class($detector) . " does not implement " . DetectorInterface::class . ".");
                }

                $detector->setLogFile($this->logFile);
                $result = $detector->detect();
                if ($result === true) {
                    return new $possibleLogClass();
                }
                if ($result === false) {
                    continue;
                }
                if (!is_numeric($result) || $result < 0 || $result > 1) {
                    throw new \InvalidArgumentException("Detector " . get_class($detector) . " returned " . var_export($result));
                }
                $detectionResults[] = ["class" => $possibleLogClass, "result" => $result];
            }
        }

        if (count($detectionResults) === 0) {
            return (new Log())->setLogFile($this->logFile);
        }

        usort($detectionResults, function ($a, $b) {
            if ($a["result"] < $b["result"]) {
                return 1;
            }

            if ($a["result"] > $b["result"]) {
                return -1;
            }

            return 0;
        });

        return (new $detectionResults[0]["class"]())->setLogFile($this->logFile);
    }
}
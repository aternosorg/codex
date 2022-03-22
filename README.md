# Codex

### About

Codex (*lat. roughly for "log"*) is a PHP library to read, parse, print and analyse log files to find problems and suggest possible
solutions. It was created mainly for Minecraft server logs but could be used for any other logs as well. This library provides a set
up for a structured log parsing implementation and provides some useful basic implementation, mainly based on RegEx. Every part
of this library can or even must be extended/overwritten while still following the interfaces, which ensure interoperability between
the different parts of this library.

### Installation

```
composer require aternos/codex
```

## Usage

This is a short introduction to the idea of Codex, for some more examples check the [test](test) folder
and/or read the [code](src).

### Logfile

A [`LogFile`](src/Log/File/LogFile.php) object implementing the [`LogFileInterface`](src/Log/File/LogFileInterface.php) object is required
to start reading a log. There are currently three different log file classes in this library.

```php
<?php

$logFile = new \Aternos\Codex\Log\File\StringLogFile("This is the log content");
$logFile = new \Aternos\Codex\Log\File\PathLogFile("/path/to/log");
$logFile = new \Aternos\Codex\Log\File\StreamLogFile(fopen("/path/to/log", "r"));
```

### Log

A [`Log`](src/Log/Log.php) object implementing the [`LogInterface`](src/Log/LogInterface.php) is the most important object
for the different operations. It represents the log content, which is split in [Entries](src/Log/EntryInterface.php) and [Lines](src/Log/LineInterface.php).
And it offers quick access to the detection, parsing and analysing functions and can define which classes are used
for those functions. If you know which log type you have or just want to test the default [Log](src/Log/Log.php) class, you can
directly create a new instance, otherwise you can use detection as described below.

```php
<?php

$log = new \Aternos\Codex\Log\Log();
$log->setLogFile($logFile);
```

### Detection

If the log type (specifically the class name of the log type) is unknown you can use the [`Detective`](src/Detective/Detective.php) class
to automatically detect the log type. The `Detective` class gets a list of possible log class names and executes
their given [Detectors](src/Detective/DetectorInterface.php).

```php
<?php

$detective = new \Aternos\Codex\Detective\Detective();
$detective->addPossibleLogClass(\Aternos\Codex\Log\Log::class);
$log = $detective->detect();
```

The `detect()` function always returns a log object, if necessary it defaults to [`Log`](src/Log/Log.php).

### Parsing

Parsing reads the entire log and creates the [`Entry`](src/Log/EntryInterface.php) and [`Line`](src/Log/LineInterface.php) objects which
are parts of a [`Log`](src/Log/LogInterface.php) object. Different log types can use different parsers by overwriting the 
`LogInterface::getDefaultParser()` function or by passing a parser object to the parse function.

```php
<?php

$log->parse();
```

### Analysing

An analysis is performed by an [`Analyser`](src/Analyser/AnalyserInterface.php) on an [`AnalysableLog`](src/Log/AnalysableLogInterface.php) and returns
an [`Analysis`](src/Analysis/AnalysisInterface.php) object containing various [`Insight`](src/Analysis/InsightInterface.php) objects, e.g. a [`Problem`](src/Analysis/ProblemInterface.php)
or an [`Information`](src/Analysis/InformationInterface.php) object. Different log types can use different analysers by overwriting
the `AnalysableLogInterface::getDefaultAnalyser()` function or by passing an analyser object to the analyse function.

```php
<?php

$analysis = $log->analyse();
```

### Printing

The entire [`Log`](src/Log/LogInterface.php) or just an [`Entry`](src/Log/EntryInterface.php) can be printed through a [`Printer`](src/Printer/PrinterInterface.php). The basic
[`DefaultPrinter`](src/Printer/DefaultPrinter.php) only prints the plain content line by line. The [`ModifiableDefaultPrinter`](src/Printer/ModifiableDefaultPrinter.php)
allows [`Modification`](src/Printer/ModificationInterface.php), e.g. to highlight certain characters/words.

```php
<?php

$printer = new \Aternos\Codex\Printer\DefaultPrinter();
$printer->setLog($log);
$printer->print();

$printer = new \Aternos\Codex\Printer\DefaultPrinter();
$printer->setEntry($entry);
$printer->print();

$printer = new \Aternos\Codex\Printer\ModifiableDefaultPrinter();
$printer->setLog($log);
$modification = new \Aternos\Codex\Printer\PatternModification();
$modification->setPattern('/foo/');
$modification->setReplacement('bar');
$printer->addModification($modification);
$printer->print();
```

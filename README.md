# PhpBCC
[![Build Status](https://travis-ci.org/chrishalbert/phpbcc.svg?branch=master)](https://travis-ci.org/chrishalbert/phpbcc)
[![Coverage Status](https://coveralls.io/repos/github/chrishalbert/phpbcc/badge.svg?branch=master)](https://coveralls.io/github/chrishalbert/phpbcc?branch=master)
[![Latest Stable Version](https://poser.pugx.org/phpbcc/phpbcc/version)](https://packagist.org/packages/phpbcc/phpbcc)
[![License](https://poser.pugx.org/phpbcc/phpbcc/license)](https://packagist.org/packages/phpbcc/phpbcc)

Php Blame Code Coverage



## Overview
This tool takes in a code coverage report and uses the version control history to provide information on authors and their code coverage.

Reports supported:
- Clover

Version Control:
- Git

## Installation

Global installation:

composer global require phpbcc/phpbcc

Local/project installation:

composer require phpbcc/phpbcc

or manually add it to the require-dev section of your composer file.

{
    "require-dev"   : {
        "phpbcc/phpbcc": "*"
    }
}

## Usage
```
> gitbcc --output-format=author reports/clover.xml
```

## Sample Output
```
phpbcc version 1.0.0 by Chris Halbert

PHP BLAME CODE COVERAGE                                                UNCOVERED OBJECTS (#/total) %

Chris Halbert                                                                             (8/8) 100%
  FileNotFoundException.php:15, 16, 17, 18                                                 (4/8) 50%
  AbstractInput.php:39, 76, 78                                                           (3/8) 37.5%
  AuthorOutput.php:157                                                                   (1/8) 12.5%
```

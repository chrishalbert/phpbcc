# PhpBCC
[![Build Status](https://travis-ci.org/chrishalbert/phpbcc.svg?branch=master)](https://travis-ci.org/chrishalbert/phpbcc)
[![Coverage Status](https://coveralls.io/repos/github/chrishalbert/phpbcc/badge.svg?branch=master)](https://coveralls.io/github/chrishalbert/phpbcc?branch=master)
[![Latest Stable Version](https://poser.pugx.org/chrishalbert/phpbcc/version)](https://packagist.org/packages/chrishalbert/phpbcc)
[![License](https://poser.pugx.org/chrishalbert/phpbcc/license)](https://packagist.org/packages/chrishalbert/phpbcc)

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
    "require-dev": {
        "phpbcc/phpbcc": "*"
    }
}

## Usage
```
> gitbcc --output-format=author reports/clover.xml
```

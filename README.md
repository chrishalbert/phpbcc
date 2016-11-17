# PhpBCC
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
> gitbcc --type=clover --vcs=git reports/clover.xml
```

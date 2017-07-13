# Php Blame Code Coverage (PhpBCC)

A tool that consumes a code coverage report and uses the version control history to report metrics on uncovered code by author.

## What is this and how can I benefit?
* **Testing Advocate** - Encourages developers to NOT introduce uncovered code
* **Coverage Bar Setter** - Implicitly increases the overall code coverage over development time once introduced 
since developers are encouraged to not introduce uncovered code.
* **Visibility** - Provides visibility to authors. Once run, the author is alerted if some of their code is not fully covered.
* **Accountability** - Assigns uncovered code to authors to fix. Tasks/user stories/tickets are always assigned to
someone to someone in part for visibility and also to make sure it gets done. This is the point of contact.
* **Boy Scout Rule** - Authors are encouraged and have full sight of code that can be cleaned up. Leave the code
cleaner than you found it.

## What is this *NOT*?
* **Performance Metric Indicator** - This assigns developers to be accountable for their's and others' code but cannot be
used to show their performance. Typically, performance metrics assess both positive and negative attributes; this
only reports on code that needs to be covered. Use the codebase's code coverage improvement to report on the 
team's quality rather than the individual.
* **100% Accurate**
    1. Edited or removed test cases may show an author that introduced uncovered lines or methods, which is not necessarily true.
    1. Merge conflict resolutions
    1. Git history is editable
    1. There's likely more..
* **Blame Bus** - Keep that blameless mentality, just assign tasks so they gone at some point and help your team want
to grow.

## Installation - 

composer global require phpbcc/phpbcc

Local/project installation:

composer require-dev phpbcc/phpbcc

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

# Php Blame Code Coverage (PhpBCC)
[![Build Status](https://travis-ci.org/chrishalbert/phpbcc.svg?branch=master)](https://travis-ci.org/chrishalbert/phpbcc)
[![Coverage Status](https://coveralls.io/repos/github/chrishalbert/phpbcc/badge.svg?branch=master)](https://coveralls.io/github/chrishalbert/phpbcc?branch=master)
[![Latest Stable Version](https://poser.pugx.org/phpbcc/phpbcc/version)](https://packagist.org/packages/phpbcc/phpbcc)
[![License](https://poser.pugx.org/phpbcc/phpbcc/license)](https://packagist.org/packages/phpbcc/phpbcc)

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
* **Blame Bus** - Keep that blameless mentality, just assign tasks so they get done at some point and help your team want
to grow.

## Installation - 

Global installation:
```bash
composer global require phpbcc/phpbcc
```

Local/project installation:

```
composer require-dev phpbcc/phpbcc
```

or manually add it to the require-dev section of your composer file.

```json
{
    "require-dev"   : {
        "phpbcc/phpbcc": "*"
    }
}
```

## Usage
```
> phpbcc --output-format=author reports/clover.xml
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

## Rollout
   1. Ask your manager/lead if it can be tested.
   1. Check your code coverage.
   1. Add it to your build process.
   1. Check code coverage after your 'testing period.'
   1. If it works, keep, if not, trash. Regardless, let me know what you think.

## Feature Requests/Bugs
   Submit feature requests or bugs at [PhpBCC Issues](https://github.com/chrishalbert/phpbcc/issues). 
   Here are some ideas on new features: SVN/CVS/Mercurial support, a report other than Clover, different output
   type.
   
## Contributing
   1. Build off of the interfaces established
   1. Ensure code coverage!
   1. Make sure the build passes
   1. Submit to [PhpBCC Pull Requests](https://github.com/chrishalbert/phpbcc/pulls)
   
## Feedback
   Let me know the successes or hardships you may experience.
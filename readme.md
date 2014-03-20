# FeatureScience!
[![Build Status](https://travis-ci.org/firstrow/feature-science.svg?branch=master)](https://travis-ci.org/firstrow/feature-science)

A PHP 5.4 library for refactoring, performance and issue testing new/old code in your production projects.

# How to use it?
For example, let's pretend you're changing caching backend. Next code example will help you to test and compare performance of new code under load.

```php
$experiment = new \FeatureScience\Test('cacher.save', [
    'control'   => function() { $this->filecache->save() }, // old code
    'candidate' => function() { $this->memcached->save() }, // new code
]);

$experiment->run();
```

## How does it works?

`$experiment->run()` will randomly select one of the testing subjects from array, run it and return result. Behind the scenes `Test::run` will collect duration, memory usage, exceptions of both behaviors and save it to the `storage`.

# Configuring
TODO

# Viewing results
TODO

# Installation
TODO

# Performance
TODO

### Links
Inspired by amazing ruby gem [dat-science](https://github.com/github/dat-science)

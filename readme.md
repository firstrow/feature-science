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
```php
use FeatureScience\FileStorage;

// Cofigure results saving storage
\FeatureScience\DI::set('storage', new FileStorage('/tmp'));
```

# Viewing results
After your have configured storage backend, you can retrieve results of exeperiment with next small piece of code:
```php
$storage = \FeatureScience\DI::get('storage');
$results = $storage->load('cache.save'); // Will return results array

print_r($results);
```

# Installation
TODO

# Performance
TODO

### Links
Inspired by ruby gem [dat-science](https://github.com/github/dat-science)

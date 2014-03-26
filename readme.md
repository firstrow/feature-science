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

`$experiment->run()` will randomly select one of the testing subjects from array, run it and return result. Behind the scenes `Test::run` will collect duration, memory usage, exceptions of both behaviors and save it to the `storage`. After 100 execution times, results will be saved by `PayloadSaver` to the specified directory. You can change this limit by calling `$experiment->setPayloadLimit(number).`

# Configuring
By default `payload.saver` saves results into system temp dir(`sys_get_temp_dir()`).
But, you can configure your own path.

**Note:** Remember to make that path writeable to web server.

```php
use FeatureScience\PayloadSaver;

// Cofigure results saving storage
\FeatureScience\DI::set('payload.saver', new PayloadSaver('/path/to/save/results'));
```

# Viewing results
You can view with your favorite editor or by typing command:

``` bash
vendor/bin/feature-science /path/to/feature.name.json
```

# Installation
TODO

# Performance
TODO

## Todo
 - Track memory usage
 - Save min, avg, max duration

### Links
Inspired by ruby gem [dat-science](https://github.com/github/dat-science)

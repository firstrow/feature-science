# FeatureScience!

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

`$experiment->run()` will randomly select one of the testing subjects, run it and return closure result.

# Configuring
TODO

# Viewing results
TODO

# Performance
TODO

### Links
Inspired by amazing ruby gem [dat-science(https://github.com/github/dat-science)

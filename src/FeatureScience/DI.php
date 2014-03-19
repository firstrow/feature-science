<?php

namespace FeatureScience;

class DI
{
    protected static $container;

    public static function set($key, $value)
    {
        self::$container[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        if (isset(self::$container[$key])) {
            return self::$container[$key];
        } else {
            return $default;
        }
    }
}

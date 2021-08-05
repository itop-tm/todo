<?php

namespace App;

class AppProvider
{
    protected static $registry = [];

    public static function bind(string $key, $val)
    {
        static::$registry[$key] = $val;
    }

    public static function get(string $key)
    {
        return static::$registry[$key];
    }
}
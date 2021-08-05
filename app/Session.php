<?php

namespace App;

class Session
{
    public static function has(string $param)
    {
        return isset($_SESSION[$param]);
    }

    public static function get(string $param)
    {
        return $_SESSION[$param] ?? null;
    }

    public static function put(string $param, $value)
    {
        return $_SESSION[$param] = $value;
    }

    public static function clear(string $param)
    {
        unset($_SESSION[$param]);
    }
}
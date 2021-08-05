<?php

namespace App;

class Request
{
    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function get(string $param)
    {
        return trim($_REQUEST[$param] ?? null);
    }

    public static function getParams()
    {
        $str = null;

        foreach ($_REQUEST as $param => $v) {
            $str .= "$param=$v&";
        }

        return $str;
    }

    public static function sortBy()
    {
        return in_array(self::get('sort_by'), [
            'is_completed', 
            'name', 
            'email'
        ]) ? self::get('sort_by') : 'is_completed';
    }
}
<?php

use App\AppProvider as App;

function setQueryString(array $params)
{
    return '?'.http_build_query(array_merge($_GET, $params));
}

function db()
{
    return App::get('db')->pdo;
}

function session()
{
    return App::get('session');
}

function request()
{
    return App::get('request');
}

function redirect(string $endpoint)
{
    header("Location: /{$endpoint}");
}

function back()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

function view(string $viewName, $context = [] )
{
    extract($context);
    $filePath = str_replace('.', '/', $viewName);
    require "views/{$filePath}.php";
}

function dd($obj)
{
    echo '<pre>';
    die(var_dump($obj));
    echo '</pre>';
}
<?php

require 'app/bootstrap.php';
use App\Router;
use App\Request;

Router::load('routes.php')
    ->direct(Request::uri(), Request::method());

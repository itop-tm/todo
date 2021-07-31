<?php
session_start();

use App\App\App;
use App\App\Session;
use App\App\Request;
use App\App\Database\{QueryBuilder, Connection};

require 'vendor/autoload.php';
require 'helpers.php';

App::bind('config', require 'config.php');

App::bind(
    'db',
    new QueryBuilder(Connection::make(App::get('config')['database']))
);

App::bind(
    'session',
    new Session()
);

App::bind(
    'request',
    new Request()
);

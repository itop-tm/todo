<?php
session_start();

use App\AppProvider as App;
use App\Session;
use App\Request;
use App\Connection;

require 'vendor/autoload.php';
require 'helpers.php';

App::bind('config', require 'config.php');

App::bind(
    'db',
    new Connection(App::get('config')['database'])
);

App::bind(
    'session',
    new Session()
);

App::bind(
    'request',
    new Request()
);

<?php

namespace App;
use \PDO;

class Connection
{
    public $pdo;

    public function __construct(array $config)
    {
        try {
            $this->pdo = new PDO(
                "{$config['driver']}:host={$config['host']};dbname={$config['dbname']}",
                $config['username'],
                $config['password'],
                $config['options']
            );
        }
        catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
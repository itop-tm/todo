<?php

namespace App\Models;

use \PDO;

class User
{
    const TABLE = 'users';

    protected $name;
    protected $email;

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public static function fetchFirst(array $parameters)
    {
        $whereClause = null;

        foreach ($parameters as $key => $value) {
            $whereClause[] = "{$key} = :{$key}";
        }

        $sql = sprintf(
            "SELECT * FROM %s WHERE %s",
            self::TABLE,
            implode(' AND ', $whereClause)
        );  

        $query = db()->prepare($sql);
        $query->execute($parameters);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
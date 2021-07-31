<?php

namespace App\Models;
use App\App\App;
use \PDO;

class Task
{
    const TABLE = 'tasks';

    public $description;
    protected $completed;
    
    public static function pdo()
    {
        return App::get('db')->pdo;
    }

    public function isComplete()
    {
        return $this->completed;
    }

    public function complete()
    {
        $this->completed = true;
    }

    public static function paginate(int $limit, int $offset, string $orderBy = 'created_at')
    {
        $query = self::pdo()->prepare("select * from tasks order by :orderBy desc LIMIT :limit OFFSET :offset");
        
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->bindValue(':orderBy', $orderBy, PDO::PARAM_STR);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function count()
    {
        $query = self::pdo()->prepare("select COUNT(id) as total from tasks");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        return $result->total ?? 0;
    }

    public static function create(array $parameters)
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            self::TABLE,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        $query =  self::pdo()->prepare($sql);

        $query->execute($parameters);
    }

    public static function markAsCompleted(int $id)
    {
        $sql = sprintf(
            "UPDATE %s SET is_completed = 1 WHERE id = :id",
            self::TABLE
        );

        $query = self::pdo()->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();
    }

    public static function update(int $id, array $parameters)
    {
        $setClause = null;

        foreach ($parameters as $key => $value) {
            $setClause[] = "{$key} = :{$key}";
        }

        $sql = sprintf(
            "UPDATE %s SET %s WHERE id = :id",
            self::TABLE,
            implode(',', $setClause)
        );
        
        $query = self::pdo()->prepare($sql);

        $query->execute(array_merge($parameters, ['id' => $id]));
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

        $query = self::pdo()->prepare($sql);
        $query->execute($parameters);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
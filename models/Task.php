<?php

namespace App\Models;
use App\App\App;
use \PDO;

class Task
{
    const TABLE = 'tasks';

    public $description;
    protected $completed;

    public function isComplete()
    {
        return $this->completed;
    }

    public function get(string $attribute)
    {
        return $this->sanitize($this->{$attribute});
    }

    public function sanitize($value) 
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public static function paginate(int $limit, int $offset, string $orderBy = 'created_at')
    {
        $query = db()->prepare("select * from tasks order by $orderBy desc LIMIT :limit OFFSET :offset");
        
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function count()
    {
        $query = db()->prepare("select COUNT(id) as total from tasks");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        return $result->total ?? 0;
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

        $query->setFetchMode(PDO::FETCH_CLASS, self::class);

        $query->execute($parameters);

        return $query->fetch();
    }

    public static function create(array $parameters)
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            self::TABLE,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        $query =  db()->prepare($sql);

        $query->execute($parameters);
    }

    public static function markAsCompleted(int $id)
    {
        $sql = sprintf(
            "UPDATE %s SET is_completed = 1 WHERE id = :id",
            self::TABLE
        );

        $query = db()->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();
    }

    public function update(array $parameters)
    {
        $dirty = $this->isDirty('description', $parameters['description']);

        if ($dirty) {
            $parameters = array_merge($parameters, ['updated_by_admin' => 1]);
        }

        $setClause = null;

        foreach ($parameters as $key => $value) {
            $setClause[] = "{$key} = :{$key}";
        }

        $sql = sprintf(
            "UPDATE %s SET %s WHERE id = :id",
            self::TABLE,
            implode(',', $setClause)
        );
        
        $query = db()->prepare($sql);

        $query->execute(array_merge($parameters, ['id' => $this->id]));
    }

    public function isDirty($parameter, $value)
    {
        return $this->{$parameter} !== $value;
    }
}
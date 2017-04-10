<?php

namespace App;


abstract class Model
{
    public $id;

    public static function findAll()
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . static::$table;
        return $db->query($sql, [], static::class)[0];
    }

    public static function findByCategoryId($id)
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE category_id = :id';
        return $db->query($sql, [':id' => $id], static::class)[0];
    }

    public static function findById($id)
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';
        return $db->query($sql, [':id' => $id], static::class)[0];
    }

    public static function countAll()
    {
        $db = DB::getInstance();
        $sql = 'SELECT COUNT(*) AS numb FROM ' . static::$table;
        return $db->query($sql, [], static::class)[0]->numb;
    }

    public function insertItem()
    {
        $db = DB::getInstance();

        $data = [];
        $keys = [];
        $substitution = [];
        foreach ($this as $key => $value) {
            if ('id' == $key) {
                continue;
            }
            $keys[] = $key;
            $substitution[] = ':' . $key;
            $data[':' . $key] = $value;

        }
        $sql = 'INSERT INTO ' . static::$table . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $substitution) . ')';

        $db->execute($sql, $data);
    }

    public function fill(array $data)
    {
        foreach ($this->fillable as $value) {
            $this->data = $data[$value];
        }

        return $this;
    }


}
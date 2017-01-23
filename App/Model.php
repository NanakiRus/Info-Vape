<?php

namespace App;


class Model
{
    public $id;

    public static function findAll()
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . static::$table;
        return $db->query($sql, [], static::class);
    }

    public static function findByCategoryId($id)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE category_id = :id';
        return $db->query($sql, [':id' => $id], static::class);
    }

    public static function findById($id)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';
        return $db->query($sql, [':id' => $id], static::class);
    }

}
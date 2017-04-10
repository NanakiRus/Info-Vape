<?php

namespace App\Model;

use App\DB;
use App\Model;

class Category
    extends Model
{

    public $fillable = [
        'parent_id',
        'name',
    ];

    public static $table = 'Category';

    public static function findChildCategoryById($id)
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . self::$table . '.parent_id = :id';
        return $db->query($sql, [':id' => $id], self::class);
    }

    public static function findParentCategoryById($id)
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . self::$table . '.id = :parent_id';
        return $db->query($sql, [':id' => $id], self::class);
    }

    public static function findUrlById($id)
    {
        $db = DB::getInstance();
        $sql = 'SELECT url FROM ' . self::$table . ' WHERE id = :id';
        return $db->query($sql, [':id' => $id], self::class);
    }

    public static function countItems($id)
    {
        $db = DB::getInstance();
        $sql = 'SELECT COUNT(*) AS numb FROM items WHERE items.category_id = :id';
        return $db->query($sql, [':id' => $id], Items::class)[0]->numb;
    }

    public static function findCategoryItemsById($id, $select = 0, int $offset = 10, $number = 1)
    {
        $db = DB::getInstance();

        $count = self::countItems($id);

        $start = ($number - 1) * $select;

        $all_pages = (int)ceil($count / $offset);

        $sql = 'SELECT * FROM Items WHERE Items.category_id = :id LIMIT ' . (int)$start . ', ' . $offset;

        return [
            'all_pages' => $all_pages,
            'items' => $db->query($sql, [':id' => $id], Items::class),
        ];
    }

}
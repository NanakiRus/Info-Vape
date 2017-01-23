<?php

namespace App\Model;

use App\Model;

class Items
    extends Model
{
    public $author_id;
    public $category_id;
    public $title;
    public $description;
    public $price;
    public $image;
    public $date;
    public $state; //состояние новое/бу
    public $condition; //состояние, допустим на 4 из 5

    public static $table = 'items';



}
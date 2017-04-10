<?php

namespace App\Model;

use App\Model;

class Items
    extends Model
{
    public $fillable = [
        'author_id',
        'category_id',
        'title',
        'description',
        'price',
        'image',
        'date',
        //состояние новое/бу
        'state',
        //состояние, допустим на 4 из 5
        'conditions',
    ];

    public static $table = 'Items';



}
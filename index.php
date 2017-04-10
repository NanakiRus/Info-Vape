<?php

require __DIR__ . '/autoload.php';

$items = new \App\Model\Items();

$cat = new \App\Controller\Category();



var_dump($cat->getCategoryItemsById());
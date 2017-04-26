<?php

require __DIR__ . '/autoload.php';

$cat = new \App\Controller\Category();

$t = new \App\Routing\Router();

$test = [
    'home' => [
        'pattern' => '/',
        'Category' => 'All',
    ],
    'mods' => [
        'pattern' => '/mods/:num',
        'Category' => 'GetChild/$1',
    ],
    'atomizers' => [
        'pattern' => '/atomizers',
        'Category' => 'GetChild',
    ],
];
$t->addArr($test);
$t->go();
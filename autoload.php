<?php

function __autoload($className) {
    require __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
}
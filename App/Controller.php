<?php

namespace App;


abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

}
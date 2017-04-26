<?php

namespace App\Controller;

use App\Controller;

class Category
    extends Controller
{

    public function getAll()
    {
        $this->view->cat = \App\Model\Category::findAllCategory();
        $this->view->display(__DIR__ . '/../../template/index.php');
    }

    public function getChild()
    {
        if (isset($_GET['id']) && '' !== $_GET['id']) {

            return \App\Model\Category::findChildCategoryById($_GET['id']);

        }
    }

    public function getParent()
    {
        if (isset($_GET['parent_id']) && '' !== $_GET['parent_id']) {

            return \App\Model\Category::findParentCategoryById($_GET['parent_id']);

        }
    }

    public function getPath()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getById()
    {
        if (isset($_GET)) {
            if (isset($_GET['id']) && '' !== $_GET['id']) {
                return \App\Model\Category::findCategoryItemsById($_GET['id']);
            }
        }
    }


}
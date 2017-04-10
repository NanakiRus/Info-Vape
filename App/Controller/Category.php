<?php

namespace App\Controller;

use App\Controller;

class Category
    extends Controller
{

    public function getChildCategory()
    {
        if (isset($_GET['id']) && '' !== $_GET['id']) {

            return \App\Model\Category::findChildCategoryById($_GET['id']);

        }
    }

    public function getParentCategory()
    {
        if (isset($_GET['parent_id']) && '' !== $_GET['parent_id']) {

            return \App\Model\Category::findParentCategoryById($_GET['parent_id']);

        }
    }

    public function getPath()
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    public function getCategoryItemsById()
    {
        if (isset($_GET)) {
            if (isset($_GET['id']) && '' !== $_GET['id']) {
                return \App\Model\Category::findCategoryItemsById($_GET['id']);
            }
        }
    }


}
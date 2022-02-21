<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryAdminService implements CategoryAdminServiceInterface
{
    public function getCategoryList()
    {
       $listCategories = Category::all();
       return $listCategories;
    }

    public function getCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return $category;
    }
}

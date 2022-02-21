<?php

namespace App\Http\Services;

use App\Models\CategoryValue;

class CategoryValueAdminService implements CategoryValueAdminServiceInterface
{
    public function getListValues($categoryId) 
    {
        $listValues = CategoryValue::where('category_id', $categoryId)
            ->get()
            ->toArray();
        return $listValues;
    }
}

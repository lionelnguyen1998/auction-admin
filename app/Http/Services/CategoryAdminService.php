<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;

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

    public function categoryValidation($request) 
    {
        $rules = [
            'icon' => "nullable|max:255",
        ];

        if (isset($request["category_id"])) {
            $categoryId = $request["category_id"];
            $rules['name'] = "required|max:255|unique:categories,name,$categoryId,category_id,deleted_at,NULL";
        } else {
            $rules['name'] = "required|max:255|unique:categories,name";
        }

        $messages = [
            'required' => __('message.validation.required'),
            'max' => sprintf(__('message.validation.max'), ':max'),
            'name.unique' => __('message.validation.uniqueCategory'),
            'integer' =>  __('message.validation.integer'),
        ];

        $attributes = [
            'name' => 'カテゴリー'
        ];

        $validated = Validator::make($request, $rules, $messages, $attributes);

        return $validated;
    }
}

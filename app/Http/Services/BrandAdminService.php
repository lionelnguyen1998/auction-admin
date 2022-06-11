<?php

namespace App\Http\Services;

use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class BrandAdminService implements BrandAdminServiceInterface
{
    public function getListBrands()
    {
       $listBrands = Brand::all();
       return $listBrands;
    }

    public function getBrand($brandId)
    {
        $brand = Brand::where('brand_id', $brandId)
            ->get()
            ->toArray();
        return $brand;
    }

    //validation brand create
    public function brandValidation($request) 
    {
        $rules = [
            'brand_info' => "nullable"
        ];

        if (isset($request["brand_id"])) {
            $brandId = $request["brand_id"];
            $rules['name'] = "required|max:255|unique:brands,name,$brandId,brand_id,deleted_at,NULL";
        } else {
            $rules['name'] = "required|max:255|unique:brands,name";
        }

        $messages = [
            'required' => __('message.validation.required'),
            'max' => sprintf(__('message.validation.max'), ':max'),
            'unique' => __('message.validation.uniqueBrand'),
        ];

        $attributes = [
            'name' => 'ブランド'
        ];

        $validated = Validator::make($request, $rules, $messages, $attributes);

        return $validated;
    }
}

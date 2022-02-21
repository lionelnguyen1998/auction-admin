<?php

namespace App\Http\Services;

use App\Models\Brand;

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
}

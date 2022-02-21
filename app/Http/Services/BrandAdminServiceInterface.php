<?php

namespace App\Http\Services;

interface BrandAdminServiceInterface
{
    public function getListBrands();
    public function getBrand($datas);
}

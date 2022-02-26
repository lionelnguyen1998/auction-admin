<?php

namespace App\Http\Services;

interface NewAdminServiceInterface
{
    public function getListNews();
    public function newValidation($datas);
    public function getInfoNew($datas);
}

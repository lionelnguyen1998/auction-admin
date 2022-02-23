<?php

namespace App\Http\Services;

interface UserAdminServiceInterface
{
    public function getUserList();
    public function getUserInfo($datas);
    public function loginValidation($datas);
    public function getAdminInfo($datas);
}

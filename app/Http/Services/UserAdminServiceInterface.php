<?php

namespace App\Http\Services;

interface UserAdminServiceInterface
{
    public function getUserList();
    public function getUserInfo($datas);
}

<?php

namespace App\Http\Services;

use App\Models\User;

class UserAdminService implements UserAdminServiceInterface
{
    public function getUserList()
    {
       $listUsers = User::all();
       return $listUsers;
    }

    public function getUserInfo($userId)
    {
        $user = User::where('user_id', $userId)
            ->get()
            ->toArray();
        return $user;
    }
}

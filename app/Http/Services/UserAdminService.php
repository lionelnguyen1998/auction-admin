<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserAdminService implements UserAdminServiceInterface
{
    public function __construct()
    {
        //Error Messages
        $this->messageRequired = config('message.MSG_01');
        $this->messageErrorFormatEmail = config('message.MSG_02');
        $this->messageErrorMax = config('message.MSG_03');
    }

    //login validation
    public function loginValidation($request) 
    {
        $rules = [
            'email' => 'required|email:filter|max:255',
            'password' => 'required|max:255'
        ];

        $messages = [
            'required' => $this->messageRequired,
            'max' => sprintf($this->messageErrorMax, ':max'),
            'email' => $this->messageErrorFormatEmail
        ];

        $attribute = [
            'email' => 'メール',
            'password' => 'パスワード'
        ];

        $validated = Validator::make($request, $rules, $messages, $attribute);

        return $validated;
    }

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

    //info admin
    public function getAdminInfo($userId) 
    {
        $info = User::findOrFail($userId);
        return $info;
    }
}

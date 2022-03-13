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

    public function userValidation($request)
    {
        $rules = [
            'password' => 'required|max:255',
            'name' => 'required|max:255',
            'address' => 'max:255',
            'phone' => 'required|max:60',
            'avatar' => 'max:255'
        ];

        $allUserId = User::withTrashed()
            ->get()
            ->pluck('user_id')
            ->toArray();

        if (isset($request["user_id"])) {
            $userId = $request["user_id"];
            $rules['email'] = "required|max:255|unique:users,email,$userId,user_id,deleted_at,NULL";
        } else {
            foreach ($allUserId as $key => $id) {
                $rules['email'] = "required|max:255|unique:users,email,$id,user_id,deleted_at,NULL";
            }
        }

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

}

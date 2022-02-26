<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UserAdminService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserAdminService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.list', [
            'title' => 'ユーザー一覧',
            'users' => $this->userService->getUserList()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        return view('admin.users.view', [
            'title' => 'ユーザー詳細', 
            'user' => $this->userService->getUserInfo($userId)
        ]);
    }

    public function info() 
    {
        $userId = auth()->user()->user_id;
        return view('admin.users.info', [
            'title' => '管理者情報',
            'user' => $this->userService->getAdminInfo($userId)
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::where('user_id', $userId)->delete();
        return redirect()->route('listUser');
    }
}

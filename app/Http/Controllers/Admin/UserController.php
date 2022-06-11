<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UserAdminService;
use App\Models\User;
use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'title' => __('message.user.list'),
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
            'title' => __('message.title.user_detail'), 
            'user' => $this->userService->getUserInfo($userId)
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'title' => __('message.user.create')
        ]);
    }

    public function store(Request $request) 
    {
        $validated = $this->userService->userValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }
        $password = Hash::make($request['password']);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $password,
            'phone' => $request['phone'],
            'address' => $request['address'],
            'avatar' => $request['thumb'],
            'role' => $request['role'],
            'user_create' => auth()->user()->user_id,
        ]);

        return redirect()->route('listUser')->with('message', __('message.toast.add'));
    }

    public function edit($userId)
    {
        return view('admin.users.create', [
            'title' => __('message.user.edit'),
            'user' => $this->userService->getAdminInfo($userId)
        ]);
    }

    public function update(Request $request)
    {
        $validated = $this->userService->userValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }

        $userId = $request->user_id;

        $user = User::findOrFail($userId);
        if ($user) {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->phone = $request['phone'];
            $user->address = $request['address'];
            $user->avatar = $request['thumb'];
            $user->role = $request['role'];
            $user->update();
        }

        return redirect()->route('listUser')->with('info',__('message.toast.edit'));
    }

    public function info() 
    {
        $userId = auth()->user()->user_id;
        return view('admin.users.info', [
            'title' => __('message.title.admin_info'),
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
        $userSelling = Auction::where('selling_user_id',  $userId)
            ->get()
            ->toArray();

        $userBid = Bid::where('user_id', $userId)
            ->get()
            ->toArray();

        if ($userSelling || $userBid) {
            return redirect()->back()->with('warning', __('message.toast.account_active'));
        } else {
            $user = User::where('user_id', $userId)->delete();
            return redirect()->route('listUser')->with('message', __('message.toast.delete'));
        }
    }
}

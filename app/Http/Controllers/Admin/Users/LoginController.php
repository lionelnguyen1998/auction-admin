<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Services\UserAdminService;

class LoginController extends Controller
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
        return view('admin.users.login', [
            'title' => __('message.title.login')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->userService->loginValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }

        $email = $request['email'];
        $password = $request['password'];
        $remember = $request['remember'];

        if (Auth::attempt([
                'email' => $email,
                'password' => $password,
                'role' => 1,
            ], $remember)) {
            //save session 
            $request->session()->put('email', $email);
            $request->session()->put('password', $password);

            //check remember 
            if (isset($remember)) {
                setcookie('email', $email, time() + 600);
                setcookie('password', $password, time() + 600);
            }

            return redirect()->route('admin'); 
        } elseif (Auth::attempt([
            'email' => $email,
            'password' => $password,
            'role' => 2,
            ])) {
                Session::flash('error', __('message.login.miss'));
                return redirect()->back();
        } else {
            Session::flash('error', __('message.login.user'));
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}

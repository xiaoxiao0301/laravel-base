<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class SessionsController extends Controller
{
    public function __construct()
    {
        // 只让未登录用户访问登录界面
        $this->middleware('guest', [
           'only' => ['create']
        ]);
    }

    /**
     * 登录页面
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        // Auth::attempt(['email' => $request->email, 'password' => $request->password])
        if (Auth::attempt($credentials, $request->has('remember'))) {
            session()->flash('success', "欢迎回来!");
            $fallback = route('users.show', Auth::user());
            // 重定向到未登录之前的页面
            return redirect()->intended($fallback);
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }


    public function destroy()
    {
        Auth::logout();
        $rememberMeCookie = Auth::getRecallerName();
        $cookie = Cookie::forget($rememberMeCookie);
        session()->flash('success', '您已成功退出!');
        return redirect()->route('login')->withCookie($cookie);
    }
}

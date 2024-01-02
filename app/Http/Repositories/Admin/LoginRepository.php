<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\LoginInterface;

class LoginRepository implements LoginInterface
{

    public function login()
    {
        return view('admin.auth.login');
    }

    public function store($request)
    {
        $remember_me = $request->has('remember_me');
        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),
            'password' => $request->input('password')] , $remember_me)){
            toast($request->name . ' مرحبا','success');
            return redirect()->route('admin.dashboard');
        }
        toast('هناك خطا في بيانات الدخول','error');
        return redirect()->back()->with(['error' => 'هناك خطأ في البيانات']);
    }

    public function logout()
    {
        $guard = $this->getGuard();
        $guard->logout();

        return redirect()->route('admin.login');
    }

    private function getGuard()
    {
        return auth('admin');
    }
}

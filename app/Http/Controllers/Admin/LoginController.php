<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\StoreLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function store(StoreLoginRequest $request){
        $remember_me = $request->has('remember_me');
        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),
            'password' => $request->input('password')] , $remember_me)){
            toast($request->name . ' مرحبا','success');
            return redirect()->route('admin.dashboard');
        }
        toast('هناك خطا في بيانات الدخول','error');
        return redirect()->back()->with(['error' => 'هناك خطأ في البيانات']);
    }
}

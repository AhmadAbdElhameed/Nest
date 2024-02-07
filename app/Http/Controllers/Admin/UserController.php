<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = Admin::latest()->where('id','<>',auth()->id())->get();

        return view('admin.users.index',compact('users'));
    }
}

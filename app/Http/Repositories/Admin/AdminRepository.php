<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminInterface;

class AdminRepository implements AdminInterface
{

    public function index()
    {
        return view('admin.index');
    }
}

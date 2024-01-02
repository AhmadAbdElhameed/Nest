<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminInterface;

class AdminController extends Controller
{
    private $adminInterface;

    public function __construct(AdminInterface $admin)
    {
        $this->adminInterface = $admin;
    }

    public function index(){
        return $this->adminInterface->index();
    }
}

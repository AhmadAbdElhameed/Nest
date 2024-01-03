<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\LoginInterface;
use App\Http\Requests\Admin\Auth\StoreLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $loginInterface;

    public function __construct(LoginInterface $login)
    {
        $this->loginInterface = $login;
    }

    public function login(){
        return $this->loginInterface->login();
    }

    public function store(StoreLoginRequest $request){
        return $this->loginInterface->store($request);
    }

    public function logout(){
        return $this->loginInterface->logout();
    }


}

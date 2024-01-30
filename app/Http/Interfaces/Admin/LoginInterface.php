<?php

namespace App\Http\Interfaces\Admin;

interface LoginInterface
{

    public function login();

    public function store($request);

    public function logout();
    public function twoFactor();
    public function twoFactorVerify($request);
}

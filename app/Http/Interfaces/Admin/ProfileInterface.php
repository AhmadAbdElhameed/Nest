<?php

namespace App\Http\Interfaces\Admin;

interface ProfileInterface
{

    public function index();

    public function update($request,$admin);
}

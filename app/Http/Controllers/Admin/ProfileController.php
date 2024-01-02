<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ProfileInterface;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $profileInterface;

    public function __construct(ProfileInterface $profile)
    {
        $this->profileInterface = $profile;
    }

    public function index(){
        return $this->profileInterface->index();
    }
    public function update(UpdateProfileRequest $request,Admin $admin){
        return $this->profileInterface->update($request,$admin);
    }
}

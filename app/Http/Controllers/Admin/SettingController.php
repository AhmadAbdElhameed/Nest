<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SettingInterface;

class SettingController extends Controller
{
    private $settingInterface;

    public function __construct(SettingInterface $setting)
    {
        $this->settingInterface = $setting;
    }

    public function editShippingMethod($shipping){
        return $this->settingInterface->editShippingMethod($shipping);
    }
}

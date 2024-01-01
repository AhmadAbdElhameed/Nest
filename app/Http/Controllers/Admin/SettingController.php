<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\Admin\SettingInterface;

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
    public function updateShippingMethod($shipping){
        return $this->settingInterface->updateShippingMethod($shipping);
    }
}

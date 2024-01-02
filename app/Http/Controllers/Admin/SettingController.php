<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\UpdateShippingRuleRequest;
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
    public function updateShippingMethod(UpdateShippingRuleRequest $request , $shipping){
        return $this->settingInterface->updateShippingMethod($request , $shipping);
    }
}

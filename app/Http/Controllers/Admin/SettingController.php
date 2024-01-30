<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\UpdateShippingRuleRequest;
use App\Models\Admin;
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

    public function edit_2fa(Admin $admin){
        return $this->settingInterface->edit_2fa($admin);
    }
    public function update_2fa(Request $request,Admin $admin){
        return $this->settingInterface->update_2fa($request,$admin);
    }
    public function enableTwoFactorAuthentication($admin){
        return $this->settingInterface->enableTwoFactorAuthentication($admin);
    }

    public function enableTwoFactor(Request $request)
    {
        return $this->settingInterface->enableTwoFactor($request);
    }
}

<?php
namespace App\Http\Interfaces\Admin;
interface SettingInterface
{

    public function editShippingMethod($shipping);

    public function updateShippingMethod($request , $shipping);

    public function edit_2fa($admin);

    public function update_2fa($request,$admin);

//    public function enableTwoFactorAuthentication($admin);

//    public function enableTwoFactor($request);
}

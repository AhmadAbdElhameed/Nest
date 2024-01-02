<?php
namespace App\Http\Interfaces\Admin;
interface SettingInterface
{

    public function editShippingMethod($shipping);

    public function updateShippingMethod($request , $shipping);
}

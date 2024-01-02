<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\SettingInterface;
use App\Models\Setting;

class SettingRepository implements SettingInterface
{

    public function editShippingMethod($shipping)
    {
        if ($shipping === 'free') {
            $shipping = Setting::where('key', 'free_shipping_label')->first();
        } elseif ($shipping === 'inner') {
            $shipping = Setting::where('key', 'local_label')->first();
        } elseif ($shipping === 'outer') {
            $shipping = Setting::where('key', 'outer_label')->first();
        } else {
            $shipping = Setting::where('key', 'free_shipping_label')->first();
        }
//        return  $shipping;
        return view('admin.settings.shipping.edit',compact('shipping'));
    }

    public function updateShippingMethod($request , $shipping)
    {
        try {
            $settings = Setting::find($shipping);
            $settings->update([
                'plain_value' => $request->plain_value,
            ]);
            // Translation
            $settings->value = $request->value;
            $settings->save();

            toast(__('admin/sidebar.shipping_updated'),'success');

            return redirect()->back();

        }catch (\Exception $ex){

        }
    }
}

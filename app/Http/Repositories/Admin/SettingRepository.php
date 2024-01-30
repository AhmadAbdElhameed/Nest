<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\SettingInterface;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PragmaRX\Google2FAQRCode\Google2FA;
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

            DB::beginTransaction();
            $settings->update([
                'plain_value' => $request->plain_value,
            ]);
            // Translation
            $settings->value = $request->value;
            $settings->save();
            DB::commit();
            toast(__('admin/sidebar.shipping_updated'),'success');

            return redirect()->back()->with(['success' => __('admin/sidebar.shipping_updated')]);

        }catch (\Exception $ex){
            toast(__('admin/sidebar.shipping_updated_fail'),'error');
            DB::rollBack();
            return redirect()->back()->with(['success' => __('admin/sidebar.shipping_updated_fail')]);
        }
    }

    public function edit_2fa($admin)
    {
        return view('admin.settings.two-factor.edit',compact('admin'));
    }

    public function update_2fa($request, $admin)
    {
        $google2fa = new Google2FA();
        $request->validate(['is_2fa_enabled' => 'required']);

        try {
            if ($request->is_2fa_enabled == '1') {
                // When enabling 2FA
                if (!$admin->auth_2fa_secret) {
                    $admin->auth_2fa_secret = $google2fa->generateSecretKey();
                }
                $admin->is_2fa_enabled = true;

                // Generate the QR code URL
                $qrCodeUrl = $google2fa->getQRCodeInline(
                    config('app.name'),
                    $admin->email,
                    $admin->auth_2fa_secret
                );

                // Save the changes
                $admin->save();

                $qrCodeUrl = $this->svgToDataUri($qrCodeUrl); // Convert SVG to Data URI

                toast('2FA Authentication Enabled', 'success');
                // Return the view with the QR code to scan
                return view('admin.settings.two-factor.enable', ['qrCodeUrl' => $qrCodeUrl]);
            } else {
                // When disabling 2FA
                $admin->auth_2fa_secret = null; // Optionally remove the secret key
                $admin->is_2fa_enabled = false;
                $admin->save();

                toast('2FA Authentication Disabled', 'success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::error('2FA Update Failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating 2FA settings.');
        }

    }

    private function svgToDataUri($qrCodeUrl) {
        $base64 = base64_encode($qrCodeUrl);
        return 'data:image/svg+xml;base64,' . $base64;
    }


}

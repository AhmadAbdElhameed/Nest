<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\ProfileInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class ProfileRepository implements ProfileInterface
{

    public function index()
    {
        $admin = Admin::find(auth('admin')->user()->id);
        return view('admin.profile.index',compact('admin'));
    }

    public function update($request,$admin)
    {
        try {
            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
            }

            unset($request['id']);
            unset($request['password_confirmation']);

            $admin->update($request->only(['name','email']));

            toast(__('admin/profile.message_success'), 'success');
            return redirect()->back()->with(['success' => __('admin/profile.message_success')]);
        }catch (\Exception $ex){
            toast(__('admin/profile.message_fail'), 'error');
            return redirect()->back()->with(['error' =>  __('admin/profile.message_fail')]);
        }


    }
}

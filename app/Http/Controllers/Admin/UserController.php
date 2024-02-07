<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\StoreAdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = Admin::latest()->where('id','<>',auth()->id())->get();

        return view('admin.users.index',compact('users'));
    }

    public function create(){
        $roles = Role::get();

        return view('admin.users.create',compact('roles'));
    }

    public function store(StoreAdminRequest $request)
    {
        // Begin a transaction in case part of the operation fails
        DB::beginTransaction();
        try {
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Ensure the password is hashed
                'role_id' => $request->role_id, // Associate the admin with a role
            ]);

            DB::commit(); // Commit the transaction if no errors
            toast('Admin created successfully','success');
            return redirect()->route('admin.user.index')->with('success', 'Admin created successfully.');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction on error
            toast('Failed to create admin. Please try again','error');
            // Redirect back with an error message
            return back()->withInput()->withErrors(['error' => 'Failed to create admin. Please try again.']);
        }
    }
}

<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\RoleInterface;
use App\Models\Role;

class RoleRepository implements RoleInterface
{

    public function index()
    {
        $roles = Role::get();
//        $roles = Role::get(['name' , 'permissions']);

        return view('admin.roles.index',compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store($request)
    {
        try {
            $role = Role::create([
                'name' => $request->name,
                // Directly assign the array to permissions
                'permissions' => $request->permissions,
            ]);

            toast('Role Created Successfully', 'success');
            return redirect()->route('admin.role.index');
        } catch (\Exception $e) {
            toast('Something wrong happened, try later', 'error');
            return redirect()->route('admin.role.index')->with(['error' => 'Something wrong happened, try later']);
        }
    }

    public function show($role)
    {
        // TODO: Implement show() method.
    }

    public function edit($role)
    {
        return view('admin.roles.edit',compact('role'));
    }

    public function update($request, $role)
    {
        try {
            $role->update([
                'name' => $request->name,
                'permissions' => $request->permissions,
            ]);

            toast('Role Updated Successfully', 'success');
            return redirect()->route('admin.role.index');
        } catch (\Exception $e) {
            toast('Something wrong happened, try later', 'error');
            return redirect()->route('admin.role.index')->with(['error' => 'Something wrong happened, try later']);
        }
    }

    public function destroy($role)
    {
        $role->delete();
        toast('Role Deleted Successfully', 'success');
        return redirect()->route('admin.role.index');
    }

}

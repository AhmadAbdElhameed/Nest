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
        // TODO: Implement edit() method.
    }

    public function update($request, $role)
    {
        // TODO: Implement update() method.
    }

    public function destroy($role)
    {
        // TODO: Implement destroy() method.
    }

}

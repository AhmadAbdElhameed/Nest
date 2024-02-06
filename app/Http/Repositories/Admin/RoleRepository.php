<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\RoleInterface;

class RoleRepository implements RoleInterface
{

    public function index()
    {
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store($request)
    {
        // TODO: Implement store() method.
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

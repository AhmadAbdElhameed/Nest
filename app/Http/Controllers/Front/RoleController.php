<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\RoleInterface;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{

    private $roleInterface;

    public function __construct(RoleInterface $role)
    {
        $this->roleInterface = $role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->roleInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->roleInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        return $this->roleInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return $this->roleInterface->show($role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return $this->roleInterface->edit($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        return $this->roleInterface->update($request,$role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        return $this->roleInterface->destroy($role);
    }
}

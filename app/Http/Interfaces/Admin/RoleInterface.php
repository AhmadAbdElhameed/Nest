<?php

namespace App\Http\Interfaces\Admin;

interface RoleInterface
{

    public function index();

    public function create();

    public function store($request);

    public function show($role);

    public function edit( $role);

    public function update($request,  $role);

    public function destroy( $role);
}

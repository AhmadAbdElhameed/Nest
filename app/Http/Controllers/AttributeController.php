<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Admin\AttributeInterface;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute;

class AttributeController extends Controller
{

    private $attributeInterface;

    public function __construct(AttributeInterface $attribute)
    {
        $this->attributeInterface = $attribute;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->attributeInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->attributeInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        return $this->attributeInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        return $this->attributeInterface->show($attribute);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        return $this->attributeInterface->edit($attribute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        return $this->attributeInterface->update($request,$attribute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        return $this->attributeInterface->destroy($attribute);
    }
}

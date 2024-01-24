<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Admin\OptionInterface;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Models\Option;

class OptionController extends Controller
{

    private $optionInterface;

    public function __construct(OptionInterface $option)
    {
        $this->optionInterface = $option;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->optionInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->optionInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOptionRequest $request)
    {
        return $this->optionInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        return $this->optionInterface->show($option);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        return $this->optionInterface->edit($option);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        return $this->optionInterface->update($request,$option);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        return $this->optionInterface->destroy($option);
    }
}

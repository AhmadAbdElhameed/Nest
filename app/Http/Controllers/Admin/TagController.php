<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\TagInterface;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;

class TagController extends Controller
{

    private $tagInterface;

    public function __construct(TagInterface $tag)
    {
        $this->tagInterface = $tag;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->tagInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->tagInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        return $this->tagInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return $this->tagInterface->show($tag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return $this->tagInterface->edit($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        return $this->tagInterface->update($request,$tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        return $this->tagInterface->destroy($tag);
    }
}

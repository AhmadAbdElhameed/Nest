<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\OptionInterface;
use App\Models\Option;

class OptionRepository implements OptionInterface
{

    public function index()
    {
        $options = Option::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('admin.options.index',compact('options'));
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function show($option)
    {
        // TODO: Implement show() method.
    }

    public function edit($option)
    {
        // TODO: Implement edit() method.
    }

    public function update($request, $option)
    {
        // TODO: Implement update() method.
    }

    public function destroy($option)
    {
        // TODO: Implement destroy() method.
    }
}

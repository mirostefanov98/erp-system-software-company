<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        return view('resources.index', compact('resources'));
    }

    public function create()
    {
        return view('resources.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'link' => 'required',
        ]);

        $resource = new Resource;
        $resource->name = $request->name;
        $resource->description = $request->description;
        $resource->link = $request->link;
        $resource->save();

        return redirect()->route('resources.index');
    }

    public function edit(Resource $resource)
    {
        return view('resources.edit', compact('resource'));
    }

    public function update(Request $request, Resource $resource)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'link' => 'required',
        ]);

        $resource->name = $request->name;
        $resource->description = $request->description;
        $resource->link = $request->link;
        $resource->save();

        return redirect()->route('resources.index');
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->route('resources.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ServiceMeta;
use Illuminate\Http\Request;

class ServiceMetaController extends Controller
{
    public function index()
    {
        $items = ServiceMeta::orderBy('id', 'desc')->paginate(15);
        return view('backend.servicemeta.index', compact('items'));
    }

    public function create()
    {
        if (ServiceMeta::count() >= 1) {
            return redirect()->route('admin.servicemeta.edit', ServiceMeta::first()->id)
                ->with('warning', 'A Service Meta already exists. You can edit it.');
        }
        return view('backend.servicemeta.create');
    }

    public function store(Request $request)
    {
        if (ServiceMeta::count() >= 1) {
            return redirect()->route('admin.servicemeta.index')->with('warning', 'Cannot create more than one Service Meta.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ServiceMeta::create($validated);

        return redirect()->route('admin.servicemeta.index')->with('success', 'Service Meta created.');
    }

    public function edit($id)
    {
        $item = ServiceMeta::findOrFail($id);
        return view('backend.servicemeta.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = ServiceMeta::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.servicemeta.index')->with('success', 'Service Meta updated.');
    }

    public function destroy($id)
    {
        $item = ServiceMeta::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.servicemeta.index')->with('success', 'Service Meta deleted.');
    }
}

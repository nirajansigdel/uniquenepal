<?php

namespace App\Http\Controllers;

use App\Models\CareerMeta;
use Illuminate\Http\Request;

class CareerMetaController extends Controller
{
    public function index()
    {
        $items = CareerMeta::orderBy('id', 'desc')->paginate(15);
        return view('backend.careermeta.index', compact('items'));
    }

    public function create()
    {
        if (CareerMeta::count() >= 1) {
            return redirect()->route('admin.careermeta.edit', CareerMeta::first()->id)
                ->with('warning', 'A Career Meta already exists. You can edit it.');
        }
        return view('backend.careermeta.create');
    }

    public function store(Request $request)
    {
        if (CareerMeta::count() >= 1) {
            return redirect()->route('admin.careermeta.index')->with('warning', 'Cannot create more than one Career Meta.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CareerMeta::create($validated);

        return redirect()->route('admin.careermeta.index')->with('success', 'Career Meta created.');
    }

    public function edit($id)
    {
        $item = CareerMeta::findOrFail($id);
        return view('backend.careermeta.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = CareerMeta::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.careermeta.index')->with('success', 'Career Meta updated.');
    }

    public function destroy($id)
    {
        $item = CareerMeta::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.careermeta.index')->with('success', 'Career Meta deleted.');
    }
}

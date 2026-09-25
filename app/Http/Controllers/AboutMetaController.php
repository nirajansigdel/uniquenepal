<?php

namespace App\Http\Controllers;

use App\Models\AboutMeta;
use Illuminate\Http\Request;

class AboutMetaController extends Controller
{
    public function index()
    {
        $items = AboutMeta::orderBy('id', 'desc')->paginate(15);
        return view('backend.aboutmeta.index', compact('items'));
    }

    public function create()
    {
        if (AboutMeta::count() >= 1) {
            return redirect()->route('admin.aboutmeta.edit', AboutMeta::first()->id)
                ->with('warning', 'An About Meta already exists. You can edit it.');
        }
        return view('backend.aboutmeta.create');
    }

    public function store(Request $request)
    {
        if (AboutMeta::count() >= 1) {
            return redirect()->route('admin.aboutmeta.index')->with('warning', 'Cannot create more than one About Meta.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        AboutMeta::create($validated);

        return redirect()->route('admin.aboutmeta.index')->with('success', 'About Meta created.');
    }

    public function edit($id)
    {
        $item = AboutMeta::findOrFail($id);
        return view('backend.aboutmeta.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = AboutMeta::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.aboutmeta.index')->with('success', 'About Meta updated.');
    }

    public function destroy($id)
    {
        $item = AboutMeta::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.aboutmeta.index')->with('success', 'About Meta deleted.');
    }
}

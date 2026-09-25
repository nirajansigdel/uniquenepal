<?php

namespace App\Http\Controllers;

use App\Models\WhyMeta;
use Illuminate\Http\Request;

class WhyMetaController extends Controller
{
    public function index()
    {
        $items = WhyMeta::orderBy('id', 'desc')->paginate(15);
        return view('backend.whymeta.index', compact('items'));
    }

    public function create()
    {
        if (WhyMeta::count() >= 1) {
            return redirect()->route('admin.whymeta.edit', WhyMeta::first()->id)
                ->with('warning', 'A Why Meta already exists. You can edit it.');
        }
        return view('backend.whymeta.create');
    }

    public function store(Request $request)
    {
        if (WhyMeta::count() >= 1) {
            return redirect()->route('admin.whymeta.index')->with('warning', 'Cannot create more than one Why Meta.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        WhyMeta::create($validated);

        return redirect()->route('admin.whymeta.index')->with('success', 'Why Meta created.');
    }

    public function edit($id)
    {
        $item = WhyMeta::findOrFail($id);
        return view('backend.whymeta.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = WhyMeta::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.whymeta.index')->with('success', 'Why Meta updated.');
    }

    public function destroy($id)
    {
        $item = WhyMeta::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.whymeta.index')->with('success', 'Why Meta deleted.');
    }
}

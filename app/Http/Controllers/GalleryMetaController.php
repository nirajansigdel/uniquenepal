<?php

namespace App\Http\Controllers;

use App\Models\GalleryMeta;
use Illuminate\Http\Request;

class GalleryMetaController extends Controller
{
    public function index()
    {
        $items = GalleryMeta::orderBy('id', 'desc')->paginate(15);
        return view('backend.gallerymeta.index', compact('items'));
    }

    public function create()
    {
        if (GalleryMeta::count() >= 1) {
            return redirect()->route('admin.gallerymeta.edit', GalleryMeta::first()->id)
                ->with('warning', 'A Gallery Meta already exists. You can edit it.');
        }
        return view('backend.gallerymeta.create');
    }

    public function store(Request $request)
    {
        if (GalleryMeta::count() >= 1) {
            return redirect()->route('admin.gallerymeta.index')->with('warning', 'Cannot create more than one Gallery Meta.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        GalleryMeta::create($validated);

        return redirect()->route('admin.gallerymeta.index')->with('success', 'Gallery Meta created.');
    }

    public function edit($id)
    {
        $item = GalleryMeta::findOrFail($id);
        return view('backend.gallerymeta.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = GalleryMeta::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.gallerymeta.index')->with('success', 'Gallery Meta updated.');
    }

    public function destroy($id)
    {
        $item = GalleryMeta::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.gallerymeta.index')->with('success', 'Gallery Meta deleted.');
    }
}

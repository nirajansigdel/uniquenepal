<?php

namespace App\Http\Controllers;

use App\Models\BlogMeta;
use Illuminate\Http\Request;

class BlogMetaController extends Controller
{
    public function index()
    {
        $items = BlogMeta::orderBy('id', 'desc')->paginate(15);
        return view('backend.blogmeta.index', compact('items'));
    }

    public function create()
    {
        // Prevent creating more than one BlogMeta
        if (BlogMeta::count() >= 1) {
            $first = BlogMeta::first();
            return redirect()->route('admin.blogmeta.edit', $first->id)
                ->with('warning', 'A Blog Meta already exists. You can edit it.');
        }

        return view('backend.blogmeta.create');
    }

    public function store(Request $request)
    {
        // Disallow creating multiple records
        if (BlogMeta::count() >= 1) {
            return redirect()->route('admin.blogmeta.index')
                ->with('warning', 'Cannot create more than one Blog Meta. Please edit the existing entry.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        BlogMeta::create($validated);

        return redirect()->route('admin.blogmeta.index')->with('success', 'Blog Meta created.');
    }

    public function edit($id)
    {
        $item = BlogMeta::findOrFail($id);
        return view('backend.blogmeta.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = BlogMeta::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.blogmeta.index')->with('success', 'Blog Meta updated.');
    }

    public function destroy($id)
    {
        $item = BlogMeta::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.blogmeta.index')->with('success', 'Blog Meta deleted.');
    }
}

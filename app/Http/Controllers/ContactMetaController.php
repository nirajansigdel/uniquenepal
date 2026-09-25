<?php

namespace App\Http\Controllers;

use App\Models\ContactMeta;
use Illuminate\Http\Request;

class ContactMetaController extends Controller
{
    public function index()
    {
        $items = ContactMeta::orderBy('id', 'desc')->paginate(15);
        return view('backend.contactmeta.index', compact('items'));
    }

    public function create()
    {
        if (ContactMeta::count() >= 1) {
            return redirect()->route('admin.contactmeta.edit', ContactMeta::first()->id)
                ->with('warning', 'A Contact Meta already exists. You can edit it.');
        }
        return view('backend.contactmeta.create');
    }

    public function store(Request $request)
    {
        if (ContactMeta::count() >= 1) {
            return redirect()->route('admin.contactmeta.index')->with('warning', 'Cannot create more than one Contact Meta.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ContactMeta::create($validated);

        return redirect()->route('admin.contactmeta.index')->with('success', 'Contact Meta created.');
    }

    public function edit($id)
    {
        $item = ContactMeta::findOrFail($id);
        return view('backend.contactmeta.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = ContactMeta::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.contactmeta.index')->with('success', 'Contact Meta updated.');
    }

    public function destroy($id)
    {
        $item = ContactMeta::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.contactmeta.index')->with('success', 'Contact Meta deleted.');
    }
}

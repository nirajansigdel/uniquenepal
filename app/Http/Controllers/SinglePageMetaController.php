<?php

namespace App\Http\Controllers;

use App\Models\SinglePageMeta;
use Illuminate\Http\Request;

class SinglePageMetaController extends Controller
{
    public function index()
    {
        $meta = SinglePageMeta::first();
        return view('backend.singlepagemeta.index', compact('meta'));
    }

    public function create()
    {
        if (SinglePageMeta::count() >= 1) {
            return redirect()->route('admin.singlepagemeta.edit', SinglePageMeta::first()->id);
        }
        return view('backend.singlepagemeta.create');
    }

    public function store(Request $request)
    {
        if (SinglePageMeta::count() >= 1) {
            return redirect()->route('admin.singlepagemeta.index')->with('warning', 'Only one record is allowed.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        SinglePageMeta::create($validated);

        return redirect()->route('admin.singlepagemeta.index')->with('success', 'Record created successfully.');
    }

    public function edit(SinglePageMeta $singlepagemeta)
    {
        return view('backend.singlepagemeta.edit', compact('singlepagemeta'));
    }

    public function update(Request $request, SinglePageMeta $singlepagemeta)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $singlepagemeta->update($validated);

        return redirect()->route('admin.singlepagemeta.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(SinglePageMeta $singlepagemeta)
    {
        $singlepagemeta->delete();
        return redirect()->route('admin.singlepagemeta.index')->with('success', 'Record deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SingleProductPageMeta;
use Illuminate\Http\Request;

class SingleProductPageMetaController extends Controller
{
    public function index()
    {
        $meta = SingleProductPageMeta::first();
        return view('backend.singleproductpagemeta.index', compact('meta'));
    }

    public function create()
    {
        if (SingleProductPageMeta::count() >= 1) {
            return redirect()->route('admin.singleproductpagemeta.edit', SingleProductPageMeta::first()->id);
        }
        return view('backend.singleproductpagemeta.create');
    }

    public function store(Request $request)
    {
        if (SingleProductPageMeta::count() >= 1) {
            return redirect()->route('admin.singleproductpagemeta.index')->with('warning', 'Only one record is allowed.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        SingleProductPageMeta::create($validated);

        return redirect()->route('admin.singleproductpagemeta.index')->with('success', 'Record created successfully.');
    }

    public function edit(SingleProductPageMeta $singleproductpagemeta)
    {
        return view('backend.singleproductpagemeta.edit', compact('singleproductpagemeta'));
    }

    public function update(Request $request, SingleProductPageMeta $singleproductpagemeta)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $singleproductpagemeta->update($validated);

        return redirect()->route('admin.singleproductpagemeta.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(SingleProductPageMeta $singleproductpagemeta)
    {
        $singleproductpagemeta->delete();
        return redirect()->route('admin.singleproductpagemeta.index')->with('success', 'Record deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ProductOneMeta;
use Illuminate\Http\Request;

class ProductOneMetaController extends Controller
{
    public function index()
    {
        $meta = ProductOneMeta::first();
        return view('backend.productonemeta.index', compact('meta'));
    }

    public function create()
    {
        if (ProductOneMeta::count() >= 1) {
            return redirect()->route('admin.productonemeta.edit', ProductOneMeta::first()->id);
        }
        return view('backend.productonemeta.create');
    }

    public function store(Request $request)
    {
        if (ProductOneMeta::count() >= 1) {
            return redirect()->route('admin.productonemeta.index')->with('warning', 'Only one record is allowed.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProductOneMeta::create($validated);

        return redirect()->route('admin.productonemeta.index')->with('success', 'Record created successfully.');
    }

    public function edit(ProductOneMeta $productonemeta)
    {
        return view('backend.productonemeta.edit', compact('productonemeta'));
    }

    public function update(Request $request, ProductOneMeta $productonemeta)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $productonemeta->update($validated);

        return redirect()->route('admin.productonemeta.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(ProductOneMeta $productonemeta)
    {
        $productonemeta->delete();
        return redirect()->route('admin.productonemeta.index')->with('success', 'Record deleted successfully.');
    }
}

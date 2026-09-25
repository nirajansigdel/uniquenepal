<?php

namespace App\Http\Controllers;

use App\Models\ProductTwoMeta;
use Illuminate\Http\Request;

class ProductTwoMetaController extends Controller
{
    public function index()
    {
        $meta = ProductTwoMeta::first();
        return view('backend.producttwometa.index', compact('meta'));
    }

    public function create()
    {
        if (ProductTwoMeta::count() >= 1) {
            return redirect()->route('admin.producttwometa.edit', ProductTwoMeta::first()->id);
        }
        return view('backend.producttwometa.create');
    }

    public function store(Request $request)
    {
        if (ProductTwoMeta::count() >= 1) {
            return redirect()->route('admin.producttwometa.index')->with('warning', 'Only one record is allowed.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProductTwoMeta::create($validated);

        return redirect()->route('admin.producttwometa.index')->with('success', 'Record created successfully.');
    }

    public function edit(ProductTwoMeta $producttwometa)
    {
        return view('backend.producttwometa.edit', compact('producttwometa'));
    }

    public function update(Request $request, ProductTwoMeta $producttwometa)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $producttwometa->update($validated);

        return redirect()->route('admin.producttwometa.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(ProductTwoMeta $producttwometa)
    {
        $producttwometa->delete();
        return redirect()->route('admin.producttwometa.index')->with('success', 'Record deleted successfully.');
    }
}

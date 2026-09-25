<?php

namespace App\Http\Controllers;

use App\Models\ProductFiveMeta;
use Illuminate\Http\Request;

class ProductFiveMetaController extends Controller
{
    public function index()
    {
        $meta = ProductFiveMeta::first();
        return view('backend.productfivemeta.index', compact('meta'));
    }

    public function create()
    {
        if (ProductFiveMeta::count() >= 1) {
            return redirect()->route('admin.productfivemeta.edit', ProductFiveMeta::first()->id);
        }
        return view('backend.productfivemeta.create');
    }

    public function store(Request $request)
    {
        if (ProductFiveMeta::count() >= 1) {
            return redirect()->route('admin.productfivemeta.index')->with('warning', 'Only one record is allowed.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProductFiveMeta::create($validated);

        return redirect()->route('admin.productfivemeta.index')->with('success', 'Record created successfully.');
    }

    public function edit(ProductFiveMeta $productfivemeta)
    {
        return view('backend.productfivemeta.edit', compact('productfivemeta'));
    }

    public function update(Request $request, ProductFiveMeta $productfivemeta)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $productfivemeta->update($validated);

        return redirect()->route('admin.productfivemeta.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(ProductFiveMeta $productfivemeta)
    {
        $productfivemeta->delete();
        return redirect()->route('admin.productfivemeta.index')->with('success', 'Record deleted successfully.');
    }
}

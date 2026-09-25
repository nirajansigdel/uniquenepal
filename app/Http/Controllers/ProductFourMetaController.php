<?php

namespace App\Http\Controllers;

use App\Models\ProductFourMeta;
use Illuminate\Http\Request;

class ProductFourMetaController extends Controller
{
    public function index()
    {
        $meta = ProductFourMeta::first();
        return view('backend.productfourmeta.index', compact('meta'));
    }

    public function create()
    {
        if (ProductFourMeta::count() >= 1) {
            return redirect()->route('admin.productfourmeta.edit', ProductFourMeta::first()->id);
        }
        return view('backend.productfourmeta.create');
    }

    public function store(Request $request)
    {
        if (ProductFourMeta::count() >= 1) {
            return redirect()->route('admin.productfourmeta.index')->with('warning', 'Only one record is allowed.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProductFourMeta::create($validated);

        return redirect()->route('admin.productfourmeta.index')->with('success', 'Record created successfully.');
    }

    public function edit(ProductFourMeta $productfourmeta)
    {
        return view('backend.productfourmeta.edit', compact('productfourmeta'));
    }

    public function update(Request $request, ProductFourMeta $productfourmeta)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $productfourmeta->update($validated);

        return redirect()->route('admin.productfourmeta.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(ProductFourMeta $productfourmeta)
    {
        $productfourmeta->delete();
        return redirect()->route('admin.productfourmeta.index')->with('success', 'Record deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ProductThreeMeta;
use Illuminate\Http\Request;

class ProductThreeMetaController extends Controller
{
    public function index()
    {
        $meta = ProductThreeMeta::first();
        return view('backend.productthreemeta.index', compact('meta'));
    }

    public function create()
    {
        if (ProductThreeMeta::count() >= 1) {
            return redirect()->route('admin.productthreemeta.edit', ProductThreeMeta::first()->id);
        }
        return view('backend.productthreemeta.create');
    }

    public function store(Request $request)
    {
        if (ProductThreeMeta::count() >= 1) {
            return redirect()->route('admin.productthreemeta.index')->with('warning', 'Only one record is allowed.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProductThreeMeta::create($validated);

        return redirect()->route('admin.productthreemeta.index')->with('success', 'Record created successfully.');
    }

    public function edit(ProductThreeMeta $productthreemeta)
    {
        return view('backend.productthreemeta.edit', compact('productthreemeta'));
    }

    public function update(Request $request, ProductThreeMeta $productthreemeta)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $productthreemeta->update($validated);

        return redirect()->route('admin.productthreemeta.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(ProductThreeMeta $productthreemeta)
    {
        $productthreemeta->delete();
        return redirect()->route('admin.productthreemeta.index')->with('success', 'Record deleted successfully.');
    }
}

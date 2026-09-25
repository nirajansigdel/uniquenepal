<?php

namespace App\Http\Controllers;

use App\Models\SingleBlogPageMeta;
use Illuminate\Http\Request;

class SingleBlogPageMetaController extends Controller
{
    public function index()
    {
        $meta = SingleBlogPageMeta::first();
        return view('backend.singleblogpagemeta.index', compact('meta'));
    }

    public function create()
    {
        if (SingleBlogPageMeta::count() >= 1) {
            return redirect()->route('admin.singleblogpagemeta.edit', SingleBlogPageMeta::first()->id);
        }
        return view('backend.singleblogpagemeta.create');
    }

    public function store(Request $request)
    {
        if (SingleBlogPageMeta::count() >= 1) {
            return redirect()->route('admin.singleblogpagemeta.index')->with('warning', 'Only one record is allowed.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        SingleBlogPageMeta::create($validated);

        return redirect()->route('admin.singleblogpagemeta.index')->with('success', 'Record created successfully.');
    }

    public function edit(SingleBlogPageMeta $singleblogpagemeta)
    {
        return view('backend.singleblogpagemeta.edit', compact('singleblogpagemeta'));
    }

    public function update(Request $request, SingleBlogPageMeta $singleblogpagemeta)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $singleblogpagemeta->update($validated);

        return redirect()->route('admin.singleblogpagemeta.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(SingleBlogPageMeta $singleblogpagemeta)
    {
        $singleblogpagemeta->delete();
        return redirect()->route('admin.singleblogpagemeta.index')->with('success', 'Record deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SingleServicePageMeta;
use Illuminate\Http\Request;

class SingleServicePageMetaController extends Controller
{
    public function index()
    {
        $meta = SingleServicePageMeta::first();
        return view('backend.singleservicepagemeta.index', compact('meta'));
    }

    public function create()
    {
        if (SingleServicePageMeta::count() >= 1) {
            return redirect()->route('admin.singleservicepagemeta.edit', SingleServicePageMeta::first()->id);
        }
        return view('backend.singleservicepagemeta.create');
    }

    public function store(Request $request)
    {
        if (SingleServicePageMeta::count() >= 1) {
            return redirect()->route('admin.singleservicepagemeta.index')->with('warning', 'Only one record is allowed.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        SingleServicePageMeta::create($validated);

        return redirect()->route('admin.singleservicepagemeta.index')->with('success', 'Record created successfully.');
    }

    public function edit(SingleServicePageMeta $singleservicepagemeta)
    {
        return view('backend.singleservicepagemeta.edit', compact('singleservicepagemeta'));
    }

    public function update(Request $request, SingleServicePageMeta $singleservicepagemeta)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $singleservicepagemeta->update($validated);

        return redirect()->route('admin.singleservicepagemeta.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(SingleServicePageMeta $singleservicepagemeta)
    {
        $singleservicepagemeta->delete();
        return redirect()->route('admin.singleservicepagemeta.index')->with('success', 'Record deleted successfully.');
    }
}

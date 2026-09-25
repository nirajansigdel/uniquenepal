<?php

namespace App\Http\Controllers;

use App\Models\TestimonialMeta;
use Illuminate\Http\Request;

class TestimonialMetaController extends Controller
{
    public function index()
    {
        $items = TestimonialMeta::orderBy('id', 'desc')->paginate(15);
        return view('backend.testimonialmeta.index', compact('items'));
    }

    public function create()
    {
        if (TestimonialMeta::count() >= 1) {
            return redirect()->route('admin.testimonialmeta.edit', TestimonialMeta::first()->id)
                ->with('warning', 'A Testimonial Meta already exists. You can edit it.');
        }
        return view('backend.testimonialmeta.create');
    }

    public function store(Request $request)
    {
        if (TestimonialMeta::count() >= 1) {
            return redirect()->route('admin.testimonialmeta.index')->with('warning', 'Cannot create more than one Testimonial Meta.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        TestimonialMeta::create($validated);

        return redirect()->route('admin.testimonialmeta.index')->with('success', 'Testimonial Meta created.');
    }

    public function edit($id)
    {
        $item = TestimonialMeta::findOrFail($id);
        return view('backend.testimonialmeta.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = TestimonialMeta::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.testimonialmeta.index')->with('success', 'Testimonial Meta updated.');
    }

    public function destroy($id)
    {
        $item = TestimonialMeta::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.testimonialmeta.index')->with('success', 'Testimonial Meta deleted.');
    }
}

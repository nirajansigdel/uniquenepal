<?php

namespace App\Http\Controllers;

use App\Models\NavigateItem;
use Illuminate\Http\Request;
use App\Services\TranslationService;
use App\Traits\HasAutoTranslation;

class NavigateItemController extends Controller
{
    use HasAutoTranslation;

    protected TranslationService $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function index()
    {
        $items = NavigateItem::orderBy('position')->latest()->paginate(12);
        return view('backend.navigate.index', compact('items'));
    }

    public function create()
    {
        return view('backend.navigate.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'link' => 'nullable|string|max:255',
            'position' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:4096',
            'show_everest' => 'nullable|boolean',
            'show_annapurna' => 'nullable|boolean',
            'show_langtang' => 'nullable|boolean',
            'show_poonhill' => 'nullable|boolean',
            'show_adventure' => 'nullable|boolean',
            'show_activities' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/navigate'), $imageName);
        }

        $item = NavigateItem::create([
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'link' => $validated['link'] ?? null,
            'position' => $validated['position'] ?? 0,
            'image' => $imageName,
            'show_everest' => (bool)$request->boolean('show_everest'),
            'show_annapurna' => (bool)$request->boolean('show_annapurna'),
            'show_langtang' => (bool)$request->boolean('show_langtang'),
            'show_poonhill' => (bool)$request->boolean('show_poonhill'),
            'show_adventure' => (bool)$request->boolean('show_adventure'),
            'show_activities' => (bool)$request->boolean('show_activities'),
            'status' => (bool)$request->boolean('status', true),
        ]);

        // Save translations if provided
        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($item, $request->all());
        }

        return redirect()->route('admin.navigate.index')->with('success', 'Navigate item created.');
    }

    public function edit(NavigateItem $navigate)
    {
        return view('backend.navigate.update', ['item' => $navigate]);
    }

    public function update(Request $request, NavigateItem $navigate)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'link' => 'nullable|string|max:255',
            'position' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:4096',
            'show_everest' => 'nullable|boolean',
            'show_annapurna' => 'nullable|boolean',
            'show_langtang' => 'nullable|boolean',
            'show_poonhill' => 'nullable|boolean',
            'show_adventure' => 'nullable|boolean',
            'show_activities' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ]);

        $imageName = $navigate->image;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/navigate'), $imageName);
        }

        $navigate->update([
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'link' => $validated['link'] ?? null,
            'position' => $validated['position'] ?? 0,
            'image' => $imageName,
            'show_everest' => (bool)$request->boolean('show_everest'),
            'show_annapurna' => (bool)$request->boolean('show_annapurna'),
            'show_langtang' => (bool)$request->boolean('show_langtang'),
            'show_poonhill' => (bool)$request->boolean('show_poonhill'),
            'show_adventure' => (bool)$request->boolean('show_adventure'),
            'show_activities' => (bool)$request->boolean('show_activities'),
            'status' => (bool)$request->boolean('status', true),
        ]);

        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($navigate, $request->all());
        }

        return redirect()->route('admin.navigate.index')->with('success', 'Navigate item updated.');
    }

    public function destroy(NavigateItem $navigate)
    {
        if ($navigate->image) {
            $path = public_path('uploads/navigate/' . $navigate->image);
            if (file_exists($path)) {
                @unlink($path);
            }
        }
        $navigate->delete();
        return redirect()->route('admin.navigate.index')->with('success', 'Navigate item deleted.');
    }
}



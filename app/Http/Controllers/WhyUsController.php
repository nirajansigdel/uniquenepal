<?php

namespace App\Http\Controllers;

use App\Models\WhyUs;
use App\Services\TranslationService;
use App\Traits\HasAutoTranslation;
use Illuminate\Http\Request;

class WhyUsController extends Controller
{
    use HasAutoTranslation;

    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    protected function getModelForTranslation($id)
    {
        return WhyUs::findOrFail($id);
    }

    protected function getTranslatableFieldsForModel($model)
    {
        return ['heading', 'subtitle', 'content'];
    }
    public function index()
    {
        $whyus = WhyUs::latest()->paginate(10);
        return view('backend.whyus.index', compact('whyus'));
    }

    public function create()
    {
        return view('backend.whyus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/whyus'), $imageName);
        }

        $whyus = WhyUs::create([
            'heading' => $request->heading,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'image' => $imageName,
        ]);

        // Save translations if provided
        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($whyus, $request->all());
        }

        return redirect()->route('backend.whyus.index')->with('success', 'Why Us item created successfully.');
    }

    public function edit($id)
    {
        $whyus = WhyUs::findOrFail($id);
        return view('backend.whyus.update', compact('whyus'));
    }

    public function update(Request $request, $id)
    {
        $whyus = WhyUs::findOrFail($id);

        $request->validate([
            'heading' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['heading', 'subtitle', 'content']);

        if ($request->hasFile('image')) {
            if ($whyus->image && file_exists(public_path('uploads/whyus/' . $whyus->image))) {
                unlink(public_path('uploads/whyus/' . $whyus->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/whyus'), $imageName);

            $data['image'] = $imageName;
        }

        $whyus->update($data);

        // Save translations if provided
        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($whyus, $request->all());
        }

        return redirect()->route('backend.whyus.index')->with('success', 'Why Us updated successfully!');
    }

    public function destroy($id)
    {
        $whyus = WhyUs::findOrFail($id);

        if ($whyus->image && file_exists(public_path('uploads/whyus/' . $whyus->image))) {
            unlink(public_path('uploads/whyus/' . $whyus->image));
        }

        $whyus->delete();

        return redirect()->route('backend.whyus.index')->with('success', 'Why Us deleted successfully!');
    }

    /**
     * Auto-translate WhyUs content to Spanish (AJAX endpoint)
     */
    public function translate(Request $request, WhyUs $whyus)
    {
        return $this->autoTranslateContent($request, $whyus->id, $this->translationService);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Services\TranslationService;
use App\Traits\HasAutoTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    use HasAutoTranslation;

    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    protected function getModelForTranslation($id)
    {
        return Career::findOrFail($id);
    }

    protected function getTranslatableFieldsForModel($model)
    {
        return ['title', 'description', 'requirements'];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = Career::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.careers.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.careers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string|max:255',
            'spots_available' => 'required|integer|min:1',
            'salary' => 'nullable|string|max:255',
            'requirements' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/careers'), $imageName);
            $data['image'] = $imageName;
        }

        $career = Career::create($data);

        // Save translations if provided
        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($career, $request->all());
        }

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career opportunity created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        return view('backend.careers.show', compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Career $career)
    {
        return view('backend.careers.edit', compact('career'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Career $career)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string|max:255',
            'spots_available' => 'required|integer|min:1',
            'salary' => 'nullable|string|max:255',
            'requirements' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($career->image && file_exists(public_path('uploads/careers/' . $career->image))) {
                unlink(public_path('uploads/careers/' . $career->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/careers'), $imageName);
            $data['image'] = $imageName;
        }

        $career->update($data);

        // Save translations if provided
        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($career, $request->all());
        }

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career opportunity updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        if ($career->image && file_exists(public_path('uploads/careers/' . $career->image))) {
            unlink(public_path('uploads/careers/' . $career->image));
        }

        $career->delete();

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career opportunity deleted successfully!');
    }

    /**
     * Toggle status of career opportunity
     */
    public function toggleStatus(Career $career)
    {
        $career->update(['status' => !$career->status]);

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career opportunity status updated successfully!');
    }

    /**
     * Auto-translate Career content to Spanish (AJAX endpoint)
     */
    public function translate(Request $request, Career $career)
    {
        return $this->autoTranslateContent($request, $career->id, $this->translationService);
    }
}

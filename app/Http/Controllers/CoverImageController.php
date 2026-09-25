<?php

namespace App\Http\Controllers;

use App\Models\CoverImage;
use App\Services\TranslationService;
use App\Traits\HasAutoTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CoverImageController extends Controller
{
    use HasAutoTranslation;

    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    protected function getModelForTranslation($id)
    {
        return CoverImage::findOrFail($id);
    }

    protected function getTranslatableFieldsForModel($model)
    {
        return ['title'];
    }
    // List all cover images
    public function index()
    {
        $coverimages = CoverImage::latest()->paginate(5);

        return view('backend.coverimage.index', [
            'coverimages' => $coverimages,
            'page_title' => 'Cover Image'
        ]);
    }

    // Show create form
    public function create()
    {
        return view('backend.coverimage.create', ['page_title' => 'Add Cover Image']);
    }

    // Store new images
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
        ]);

        try {
            $imageNames = [];

            foreach ($request->file('images') as $image) {
                $newImageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/coverimage'), $newImageName);
                $imageNames[] = $newImageName;
            }

            $coverImage = CoverImage::create([
                'title' => $request->title,
                'image' => $imageNames, // Stored as array (json in DB)
            ]);

            // Save translations if provided
            if ($request->has('translations')) {
                $this->translationService->saveFromRequest($coverImage, $request->all());
            }

            return redirect()->route('admin.cover-images.index')->with('success', 'Success! Cover images created.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error uploading images: ' . $e->getMessage());
        }
    }

    // Show edit form
    public function edit($id)
    {
        $coverimage = CoverImage::find($id);

        if (!$coverimage) {
            return redirect()->route('admin.cover-images.index')->with('error', 'Cover Image not found.');
        }

        return view('backend.coverimage.update', [
            'coverimage' => $coverimage,
            'page_title' => 'Update Cover Image'
        ]);
    }

    // Update image and title
    public function update(Request $request, $id)
    {
        $coverimage = CoverImage::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $coverimage->title = $request->input('title');

        if ($request->hasFile('images')) {
            $uploadedImages = [];

            foreach ($request->file('images') as $file) {
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/coverimage'), $filename);
                $uploadedImages[] = $filename;
            }

            // Merge with existing images
            $existingImages = is_array($coverimage->image) ? $coverimage->image : json_decode($coverimage->image, true) ?? [];
            $coverimage->image = array_merge($existingImages, $uploadedImages);
        }

        $coverimage->save();

        // Save translations if provided
        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($coverimage, $request->all());
        }

        return redirect()->route('admin.cover-images.index')->with('success', 'Cover image updated successfully.');
    }

    // Delete image and record
    public function destroy($id)
    {
        $coverimage = CoverImage::find($id);

        if ($coverimage) {
            // Delete all associated images
            $images = is_array($coverimage->image) ? $coverimage->image : json_decode($coverimage->image, true);

            if (!empty($images)) {
                foreach ($images as $img) {
                    $imagePath = public_path('uploads/coverimage/' . $img);
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                }
            }

            $coverimage->delete();

            return redirect()->route('admin.cover-images.index')->with('success', 'Success! Cover Image Deleted');
        } else {
            return redirect()->route('admin.cover-images.index')->with('error', 'Cover Image not found.');
        }
    }

    /**
     * Auto-translate CoverImage content to Spanish (AJAX endpoint)
     */
    public function translate(Request $request, CoverImage $coverImage)
    {
        return $this->autoTranslateContent($request, $coverImage->id, $this->translationService);
    }
}

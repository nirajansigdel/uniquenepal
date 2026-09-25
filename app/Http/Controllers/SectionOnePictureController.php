<?php

namespace App\Http\Controllers;

use App\Models\SectionOnePicture;
use Illuminate\Http\Request;

class SectionOnePictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */public function index()
{
    $sectiononepictures = SectionOnePicture::all();
    return view('backend.sectiononepicture.index', compact('sectiononepictures'));
}


    /**
     * Show the form for creating a new image.
     */
    public function create()
    {
        return view('backend.sectiononepicture.create');
    }

    /**
     * Store a newly created image.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Folder path: /public/uploads/sectiononepicture
        $uploadPath = public_path('uploads/sectiononepicture');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($uploadPath, $imageName);
            $imagePath = 'uploads/sectiononepicture/' . $imageName;
        } else {
            $imagePath = null;
        }

        SectionOnePicture::create([
            'title' => $request->title,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.sectiononepicture.index')->with('success', 'Image uploaded successfully.');
    }

    /**
     * Show the form for editing an existing image.
     */
    public function edit(SectionOnePicture $sectiononepicture)
    {
        return view('backend.sectiononepicture.edit', compact('sectiononepicture'));
    }

    /**
     * Update an existing image.
     */
    public function update(Request $request, SectionOnePicture $sectiononepicture)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploadPath = public_path('uploads/sectiononepicture');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // If a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($sectiononepicture->image_path && file_exists(public_path($sectiononepicture->image_path))) {
                unlink(public_path($sectiononepicture->image_path));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($uploadPath, $imageName);
            $sectiononepicture->image_path = 'uploads/sectiononepicture/' . $imageName;
        }

        $sectiononepicture->title = $request->title ?? $sectiononepicture->title;
        $sectiononepicture->save();

        return redirect()->route('admin.sectiononepicture.index')->with('success', 'Image updated successfully.');
    }

    /**
     * Remove an image.
     */
    public function destroy(SectionOnePicture $sectiononepicture)
    {
        // Delete image file from disk
        if ($sectiononepicture->image_path && file_exists(public_path($sectiononepicture->image_path))) {
            unlink(public_path($sectiononepicture->image_path));
        }

        $sectiononepicture->delete();

        return redirect()->route('admin.sectiononepicture.index')->with('success', 'Image deleted successfully.');
    }
}

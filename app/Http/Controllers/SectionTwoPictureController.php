<?php

namespace App\Http\Controllers;

use App\Models\SectionTwoPicture;
use Illuminate\Http\Request;

class SectionTwoPictureController extends Controller
{
    public function index()
    {
        $sectiontwopictures = SectionTwoPicture::all();
        return view('backend.sectiontwopicture.index', compact('sectiontwopictures'));
    }

    public function create()
    {
        return view('backend.sectiontwopicture.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploadPath = public_path('uploads/sectiontwopicture');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($uploadPath, $imageName);
            $imagePath = 'uploads/sectiontwopicture/' . $imageName;
        } else {
            $imagePath = null;
        }

        SectionTwoPicture::create([
            'title' => $request->title,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.sectiontwopicture.index')->with('success', 'Image uploaded successfully.');
    }

    public function edit(SectionTwoPicture $sectiontwopicture)
    {
        return view('backend.sectiontwopicture.edit', compact('sectiontwopicture'));
    }

    public function update(Request $request, SectionTwoPicture $sectiontwopicture)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploadPath = public_path('uploads/sectiontwopicture');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('image')) {
            if ($sectiontwopicture->image_path && file_exists(public_path($sectiontwopicture->image_path))) {
                unlink(public_path($sectiontwopicture->image_path));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($uploadPath, $imageName);
            $sectiontwopicture->image_path = 'uploads/sectiontwopicture/' . $imageName;
        }

        $sectiontwopicture->title = $request->title ?? $sectiontwopicture->title;
        $sectiontwopicture->save();

        return redirect()->route('admin.sectiontwopicture.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(SectionTwoPicture $sectiontwopicture)
    {
        if ($sectiontwopicture->image_path && file_exists(public_path($sectiontwopicture->image_path))) {
            unlink(public_path($sectiontwopicture->image_path));
        }

        $sectiontwopicture->delete();
        return redirect()->route('admin.sectiontwopicture.index')->with('success', 'Image deleted successfully.');
    }
}

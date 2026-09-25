<?php

namespace App\Http\Controllers;

use App\Models\SectionFourPicture;
use Illuminate\Http\Request;

class SectionFourPictureController extends Controller
{
    public function index()
    {
        $sectionfourpictures = SectionFourPicture::all();
        return view('backend.sectionfourpicture.index', compact('sectionfourpictures'));
    }

    public function create()
    {
        return view('backend.sectionfourpicture.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploadPath = public_path('uploads/sectionfourpicture');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($uploadPath, $imageName);
            $imagePath = 'uploads/sectionfourpicture/' . $imageName;
        } else {
            $imagePath = null;
        }

        SectionFourPicture::create([
            'title' => $request->title,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.sectionfourpicture.index')->with('success', 'Image uploaded successfully.');
    }

    public function edit(SectionFourPicture $sectionfourpicture)
    {
        return view('backend.sectionfourpicture.edit', compact('sectionfourpicture'));
    }

    public function update(Request $request, SectionFourPicture $sectionfourpicture)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploadPath = public_path('uploads/sectionfourpicture');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('image')) {
            if ($sectionfourpicture->image_path && file_exists(public_path($sectionfourpicture->image_path))) {
                unlink(public_path($sectionfourpicture->image_path));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($uploadPath, $imageName);
            $sectionfourpicture->image_path = 'uploads/sectionfourpicture/' . $imageName;
        }

        $sectionfourpicture->title = $request->title ?? $sectionfourpicture->title;
        $sectionfourpicture->save();

        return redirect()->route('admin.sectionfourpicture.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(SectionFourPicture $sectionfourpicture)
    {
        if ($sectionfourpicture->image_path && file_exists(public_path($sectionfourpicture->image_path))) {
            unlink(public_path($sectionfourpicture->image_path));
        }

        $sectionfourpicture->delete();
        return redirect()->route('admin.sectionfourpicture.index')->with('success', 'Image deleted successfully.');
    }
}

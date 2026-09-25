<?php

namespace App\Http\Controllers;

use App\Models\SectionThreePicture;
use Illuminate\Http\Request;

class SectionThreePictureController extends Controller
{
    public function index()
    {
        $sectionthreepictures = SectionThreePicture::all();
        return view('backend.sectionthreepicture.index', compact('sectionthreepictures'));
    }

    public function create()
    {
        return view('backend.sectionthreepicture.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploadPath = public_path('uploads/sectionthreepicture');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($uploadPath, $imageName);
            $imagePath = 'uploads/sectionthreepicture/' . $imageName;
        } else {
            $imagePath = null;
        }

        SectionThreePicture::create([
            'title' => $request->title,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.sectionthreepicture.index')->with('success', 'Image uploaded successfully.');
    }

    public function edit(SectionThreePicture $sectionthreepicture)
    {
        return view('backend.sectionthreepicture.edit', compact('sectionthreepicture'));
    }

    public function update(Request $request, SectionThreePicture $sectionthreepicture)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploadPath = public_path('uploads/sectionthreepicture');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('image')) {
            if ($sectionthreepicture->image_path && file_exists(public_path($sectionthreepicture->image_path))) {
                unlink(public_path($sectionthreepicture->image_path));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($uploadPath, $imageName);
            $sectionthreepicture->image_path = 'uploads/sectionthreepicture/' . $imageName;
        }

        $sectionthreepicture->title = $request->title ?? $sectionthreepicture->title;
        $sectionthreepicture->save();

        return redirect()->route('admin.sectionthreepicture.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(SectionThreePicture $sectionthreepicture)
    {
        if ($sectionthreepicture->image_path && file_exists(public_path($sectionthreepicture->image_path))) {
            unlink(public_path($sectionthreepicture->image_path));
        }

        $sectionthreepicture->delete();
        return redirect()->route('admin.sectionthreepicture.index')->with('success', 'Image deleted successfully.');
    }
}

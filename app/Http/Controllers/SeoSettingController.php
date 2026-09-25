<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoSettingController extends Controller
{
    public function index()
    {
        $seoSettings = SeoSetting::paginate(10); // Use pagination
        return view('backend.seo_settings.index', compact('seoSettings'));
    }

    public function create()
    {
        // Only one SEO Setting record is allowed
        if (SeoSetting::count() >= 1) {
            return redirect()->route('backend.seo_settings.edit', SeoSetting::first()->id)
                ->with('info', 'Only one SEO Setting can exist. Edit the existing one below.');
        }
        return view('backend.seo_settings.create');
    }

    public function store(Request $request)
    {
        // Block creation if a record already exists
        if (SeoSetting::count() >= 1) {
            return redirect()->route('backend.seo_settings.edit', SeoSetting::first()->id)
                ->with('warning', 'Only one SEO Setting is allowed. Please edit the existing one.');
        }

        $validated = $request->validate([
            'meta_title' => 'nullable|array',
            'meta_title.*' => 'nullable|string|max:255',

            'meta_description' => 'nullable|array',
            'meta_description.*' => 'nullable|string|max:255',

            'meta_keywords' => 'nullable|array',
            'meta_keywords.*' => 'nullable|string|max:255',

            'canonical_url' => 'nullable|array',
            'canonical_url.*' => 'nullable|url|max:255',

            'schema_json' => 'nullable|array',
            'schema_json.*' => 'nullable|string',

            'heading_h1' => 'nullable|array',
            'heading_h1.*' => 'nullable|string|max:255',

            'image_description' => 'nullable|array',
            'image_description.*' => 'nullable|string',
        ]);

        $seoSetting = new SeoSetting();

        $seoSetting->meta_title = !empty($validated['meta_title']) ? json_encode(array_filter($validated['meta_title'])) : null;
        $seoSetting->meta_description = !empty($validated['meta_description']) ? json_encode(array_filter($validated['meta_description'])) : null;
        $seoSetting->meta_keywords = !empty($validated['meta_keywords']) ? json_encode(array_filter($validated['meta_keywords'])) : null;
        $seoSetting->canonical_url = !empty($validated['canonical_url']) ? json_encode(array_filter($validated['canonical_url'])) : null;
        $seoSetting->schema_json = !empty($validated['schema_json']) ? json_encode(array_filter($validated['schema_json'])) : null;
        $seoSetting->heading_h1 = !empty($validated['heading_h1']) ? json_encode(array_filter($validated['heading_h1'])) : null;
        $seoSetting->image_description = !empty($validated['image_description']) ? json_encode(array_filter($validated['image_description'])) : null;

        $seoSetting->save();

        return redirect()->route('backend.seo_settings.edit', $seoSetting->id)->with('success', 'SEO Setting created successfully.');
    }

    public function edit($id)
    {
        $seoSetting = SeoSetting::findOrFail($id);
        return view('backend.seo_settings.edit', compact('seoSetting'));
    }

    public function update(Request $request, $id)
    {
        $seoSetting = SeoSetting::findOrFail($id);

        $validated = $request->validate([
            'meta_title' => 'nullable|array',
            'meta_title.*' => 'nullable|string|max:255',

            'meta_description' => 'nullable|array',
            'meta_description.*' => 'nullable|string|max:255',

            'meta_keywords' => 'nullable|array',
            'meta_keywords.*' => 'nullable|string|max:255',

            'canonical_url' => 'nullable|array',
            'canonical_url.*' => 'nullable|url|max:255',

            'schema_json' => 'nullable|array',
            'schema_json.*' => 'nullable|string',

            'heading_h1' => 'nullable|array',
            'heading_h1.*' => 'nullable|string|max:255',

            'image_description' => 'nullable|array',
            'image_description.*' => 'nullable|string',
        ]);

        $seoSetting->meta_title = !empty($validated['meta_title']) ? json_encode(array_filter($validated['meta_title'])) : null;
        $seoSetting->meta_description = !empty($validated['meta_description']) ? json_encode(array_filter($validated['meta_description'])) : null;
        $seoSetting->meta_keywords = !empty($validated['meta_keywords']) ? json_encode(array_filter($validated['meta_keywords'])) : null;
        $seoSetting->canonical_url = !empty($validated['canonical_url']) ? json_encode(array_filter($validated['canonical_url'])) : null;
        $seoSetting->schema_json = !empty($validated['schema_json']) ? json_encode(array_filter($validated['schema_json'])) : null;
        $seoSetting->heading_h1 = !empty($validated['heading_h1']) ? json_encode(array_filter($validated['heading_h1'])) : null;
        $seoSetting->image_description = !empty($validated['image_description']) ? json_encode(array_filter($validated['image_description'])) : null;

        $seoSetting->save();

        return redirect()->route('backend.seo_settings.index')->with('success', 'SEO Setting updated successfully.');
    }

    public function destroy($id)
    {
        $seoSetting = SeoSetting::findOrFail($id);
        $seoSetting->delete();

        return redirect()->route('backend.seo_settings.index')->with('success', 'SEO Setting deleted successfully.');
    }
}

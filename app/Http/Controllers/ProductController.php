<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\TranslationService;
use App\Traits\HasAutoTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use HasAutoTranslation;

    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    protected function getModelForTranslation($id)
    {
        return Product::findOrFail($id);
    }

    protected function getTranslatableFieldsForModel($model)
    {
        return ['heading', 'subtitle', 'content', 'location', 'transportation', 'package', 'includes', 'excludes'];
    }

    public function index()
    {
        $products = Product::latest()->paginate(12);
        $page_title = 'Products';

        return view('backend.products.index', compact('products', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Add New Product';
        return view('backend.products.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        /** ✅ Everything is now OPTIONAL **/
        $validated = $request->validate([
            'heading' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'duration' => 'nullable|string|max:255',
            'people' => 'nullable|integer|min:1',
            'package' => 'nullable|string|max:255',
            'original_price' => 'nullable|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'transportation' => 'nullable|string|max:255',
            'content' => 'nullable|string',

            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:4096',

            'videos' => 'nullable|array',
            'videos.*' => 'nullable|file|mimes:mp4,mov,webm,ogg|max:20480',

            'product_types' => 'nullable|array',
            'product_types.*' => 'nullable|string',

           'includes'   => 'nullable|array',
'includes.*' => 'nullable|string|max:255',

            'excludes' => 'nullable|array',
            'excludes.*' => 'nullable|string|max:255',

            'status' => 'nullable|boolean',
        ]);

        // ✅ Handle multiple images (optional)
        $galleryImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $gimg) {
                $gname = time() . '_' . uniqid() . '_' . $gimg->getClientOriginalName();
                $gimg->move(public_path('uploads/products'), $gname);
                $galleryImages[] = $gname;
            }
        }

        // ✅ Handle short video clips (optional)
        $galleryVideos = [];

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $gvideo) {
                $vname = time() . '_' . uniqid() . '_' . $gvideo->getClientOriginalName();
                $gvideo->move(public_path('uploads/products/videos'), $vname);
                $galleryVideos[] = $vname;
            }
        }

        // ✅ Filter empty includes / excludes
        $includes = array_filter($request->input('includes', []), function ($value) {
            return !empty(trim($value));
        });
        $excludes = array_filter($request->input('excludes', []), function ($value) {
            return !empty(trim($value));
        });

        $product = Product::create([
            'heading' => $validated['heading'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'date' => $validated['date'] ?? null,
            'duration' => $validated['duration'] ?? null,
            'people' => $validated['people'] ?? null,
            'package' => $validated['package'] ?? null,
            'original_price' => $validated['original_price'] ?? null,
            'discounted_price' => $validated['discounted_price'] ?? null,
            'location' => $validated['location'] ?? null,
            'transportation' => $validated['transportation'] ?? null,
            'content' => $validated['content'] ?? null,

            'images' => $galleryImages,
            'videos' => $galleryVideos,
            'product_types' => $request->input('product_types'),
            'includes' => $includes,
            'excludes' => $excludes,
            'status' => (bool)($request->input('status', 1)),
        ]);

        // ✅ Save translations if provided
        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($product, $request->all());
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $page_title = 'Edit Product';

        return view('backend.products.update', compact('product', 'page_title'));
    }

    public function update(Request $request, Product $product)
    {
        /** ✅ Everything OPTIONAL here also **/
        $validated = $request->validate([
            'heading' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'duration' => 'nullable|string|max:255',
            'people' => 'nullable|integer|min:1',
            'package' => 'nullable|string|max:255',
            'original_price' => 'nullable|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'transportation' => 'nullable|string|max:255',
            'content' => 'nullable|string',

            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:4096',

            'videos' => 'nullable|array',
            'videos.*' => 'nullable|file|mimes:mp4,mov,webm,ogg|max:20480',

            'product_types' => 'nullable|array',
            'product_types.*' => 'nullable|string',

            'includes' => 'nullable|array',
            'includes.*' => 'nullable|string|max:255',

            'excludes' => 'nullable|array',
            'excludes.*' => 'nullable|string|max:255',

            'status' => 'nullable|boolean',
        ]);

        // ✅ Handle images (append new ones, keep old)
        $existingImages = is_array($product->images) ? $product->images : [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $gimg) {
                $gname = time() . '_' . uniqid() . '_' . $gimg->getClientOriginalName();
                $gimg->move(public_path('uploads/products'), $gname);
                $existingImages[] = $gname;
            }
        }

        // ✅ Handle short video clips (append new ones, keep old)
        $existingVideos = is_array($product->videos) ? $product->videos : [];

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $gvideo) {
                $vname = time() . '_' . uniqid() . '_' . $gvideo->getClientOriginalName();
                $gvideo->move(public_path('uploads/products/videos'), $vname);
                $existingVideos[] = $vname;
            }
        }

        // ✅ Filter empty includes / excludes
        $includes = array_filter($request->input('includes', []), function ($value) {
            return !empty(trim($value));
        });
        $excludes = array_filter($request->input('excludes', []), function ($value) {
            return !empty(trim($value));
        });

        $product->update([
            'heading' => $validated['heading'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'date' => $validated['date'] ?? null,
            'duration' => $validated['duration'] ?? null,
            'people' => $validated['people'] ?? null,
            'package' => $validated['package'] ?? null,
            'original_price' => $validated['original_price'] ?? null,
            'discounted_price' => $validated['discounted_price'] ?? null,
            'location' => $validated['location'] ?? null,
            'transportation' => $validated['transportation'] ?? null,
            'content' => $validated['content'] ?? null,

            'images' => $existingImages,
            'videos' => $existingVideos,
            'product_types' => $request->input('product_types'),
            'includes' => $includes,
            'excludes' => $excludes,
            'status' => (bool)($request->input('status', 1)),
        ]);

        // ✅ Save translations if provided
        if ($request->has('translations')) {
            $this->translationService->saveFromRequest($product, $request->all());
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Auto-translate Product content
     */
    public function translate(Request $request, Product $product)
    {
        return $this->autoTranslateContent($request, $product->id, $this->translationService);
    }

    /**
     * Delete an individual image from the product gallery by index.
     */
    public function deleteImage(Request $request, Product $product, int $index)
    {
        $images = is_array($product->images) ? $product->images : [];

        if ($index < 0 || $index >= count($images)) {
            return back()->with('error', 'Invalid image selection.');
        }

        $filename = $images[$index];
        $filePath = public_path('uploads/products/' . $filename);

        // Remove file from disk if exists
        if (is_file($filePath)) {
            @unlink($filePath);
        }

        // Remove from array and reindex
        unset($images[$index]);
        $images = array_values($images);

        $product->update(['images' => $images]);

        return back()->with('success', 'Image deleted successfully.');
    }

    /**
     * Delete an individual video clip from the product by index.
     */
    public function deleteVideo(Request $request, Product $product, int $index)
    {
        $videos = is_array($product->videos) ? $product->videos : [];

        if ($index < 0 || $index >= count($videos)) {
            return back()->with('error', 'Invalid video selection.');
        }

        $filename = $videos[$index];
        $filePath = public_path('uploads/products/videos/' . $filename);

        if (is_file($filePath)) {
            @unlink($filePath);
        }

        unset($videos[$index]);
        $videos = array_values($videos);

        $product->update(['videos' => $videos]);

        return back()->with('success', 'Video deleted successfully.');
    }

    public function destroy(Product $product)
    {
        /** ✅ Properly delete multiple images **/
        if (is_array($product->images)) {
            foreach ($product->images as $image) {
                $path = public_path('uploads/products/' . $image);

                if (file_exists($path)) {
                    @unlink($path);
                }
            }
        }

        /** ✅ Properly delete video clips **/
        if (is_array($product->videos)) {
            foreach ($product->videos as $video) {
                $path = public_path('uploads/products/videos/' . $video);

                if (file_exists($path)) {
                    @unlink($path);
                }
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}

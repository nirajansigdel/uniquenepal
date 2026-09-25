<?php

namespace App\Http\Controllers;

use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TranslationController extends Controller
{
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->middleware('auth');
        $this->translationService = $translationService;
    }

    /**
     * Show translation form for a model
     */
    public function edit(Request $request, $modelType, $modelId)
    {
        $model = $this->getModel($modelType, $modelId);
        
        if (!$model) {
            return redirect()->back()->with('error', 'Model not found.');
        }

        $availableLocales = $this->translationService->getAvailableLocales();
        $translations = [];
        
        foreach ($availableLocales as $locale) {
            $translations[$locale] = $this->translationService->getAll($model, $locale);
        }

        $translatableFields = $this->getTranslatableFields($model);

        return view('backend.translations.edit', compact(
            'model',
            'modelType',
            'modelId',
            'availableLocales',
            'translations',
            'translatableFields'
        ));
    }

    /**
     * Update translations for a model
     */
    public function update(Request $request, $modelType, $modelId)
    {
        $model = $this->getModel($modelType, $modelId);
        
        if (!$model) {
            return redirect()->back()->with('error', 'Model not found.');
        }

        $this->translationService->saveFromRequest($model, $request->all());

        return redirect()->back()->with('success', 'Translations updated successfully.');
    }

    /**
     * Get model instance by type and ID
     */
    protected function getModel($modelType, $modelId)
    {
        $modelClass = $this->getModelClass($modelType);
        
        if (!$modelClass || !class_exists($modelClass)) {
            return null;
        }

        return $modelClass::find($modelId);
    }

    /**
     * Get model class name from type string
     */
    protected function getModelClass($modelType)
    {
        $models = [
            'product' => \App\Models\Product::class,
            'event' => \App\Models\Event::class,
            'post' => \App\Models\Post::class,
            'service' => \App\Models\Service::class,
            'about' => \App\Models\About::class,
            'faq' => \App\Models\Faq::class,
            'testimonial' => \App\Models\Testimonial::class,
            'category' => \App\Models\Category::class,
            'country' => \App\Models\Country::class,
            'team' => \App\Models\Team::class,
            'career' => \App\Models\Career::class,
            'whyus' => \App\Models\WhyUs::class,
            'coverimage' => \App\Models\CoverImage::class,
            'directormessage' => \App\Models\DirectorMessage::class,
            'ceomessage' => \App\Models\DirectorMessage::class,
            'missionvisionvalue' => \App\Models\MissionVisionValue::class,
            'blogpostscategory' => \App\Models\BlogPostsCategory::class,
            'blog' => \App\Models\BlogPostsCategory::class,
        ];

        return $models[$modelType] ?? null;
    }

    /**
     * Get translatable fields for a model
     */
    protected function getTranslatableFields($model)
    {
        $modelType = class_basename($model);
        
        $fields = [
            'Product' => ['heading', 'subtitle', 'content', 'location', 'transportation', 'package', 'includes'],
            'Event' => ['heading', 'subtitle', 'content'],
            'Post' => ['title', 'description'],
            'Service' => ['title', 'description', 'keywords'],
            'About' => ['title', 'subtitle', 'description', 'content'],
            'Faq' => ['question', 'answer'],
            'Testimonial' => ['name', 'description'],
            'Category' => ['title'],
            'Country' => ['name', 'content'],
            'Team' => ['name', 'position'],
            'Career' => ['title', 'description', 'requirements'],
            'WhyUs' => ['heading', 'subtitle', 'content'],
            'CoverImage' => ['title'],
            'DirectorMessage' => ['name', 'position', 'companyName', 'message'],
            'MissionVisionValue' => ['heading', 'description'],
            'BlogPostsCategory' => ['title', 'content'],
        ];

        // Filter out fields that don't exist on the model
        $availableFields = [];
        foreach ($fields[$modelType] ?? [] as $field) {
            if (in_array($field, $model->getFillable()) || $model->hasAttribute($field)) {
                $availableFields[] = $field;
            }
        }

        return $availableFields;
    }

    /**
     * Generic translation endpoint for create pages (no model ID required)
     */
    public function translateGeneric(Request $request)
    {
        try {
            $translations = [];
            $fields = $request->all();
            
            foreach ($fields as $field => $text) {
                // Handle array fields (like includes)
                if ($field === 'includes' && is_array($text)) {
                    $translatedArray = [];
                    foreach ($text as $item) {
                        if (!empty(trim($item))) {
                            $translatedItem = $this->translationService->autoTranslate(trim($item), 'es', 'en');
                            if ($translatedItem && $translatedItem !== trim($item)) {
                                $translatedArray[] = $translatedItem;
                            } else {
                                $translatedArray[] = trim($item); // Fallback to original
                            }
                        }
                    }
                    if (!empty($translatedArray)) {
                        $translations[$field] = $translatedArray;
                    }
                } elseif (!empty($text)) {
                    // Strip HTML tags for translation
                    $plainText = strip_tags($text);
                    $plainText = trim($plainText);
                    
                    if (!empty($plainText)) {
                        $translated = $this->translationService->autoTranslate($plainText, 'es', 'en');
                        
                        if ($translated && $translated !== $plainText && trim($translated) !== trim($plainText)) {
                            $translations[$field] = $translated;
                        }
                    }
                }
            }
            
            return response()->json([
                'success' => true,
                'translations' => $translations
            ]);
        } catch (\Exception $e) {
            \Log::error('Generic translation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Translation failed: ' . $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Traits;

use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait HasAutoTranslation
{
    /**
     * Auto-translate model content to Spanish (AJAX endpoint)
     */
    public function autoTranslateContent(Request $request, $id, TranslationService $translationService)
    {
        try {
            $model = $this->getModelForTranslation($id);
            
            if (!$model) {
                return response()->json([
                    'success' => false,
                    'message' => 'Model not found.'
                ], 404);
            }
            
            $translations = [];
            $fields = $this->getTranslatableFieldsForModel($model);
            
            foreach ($fields as $field) {
                $text = $request->input($field, '');
                
                // Handle array fields (like includes)
                if ($field === 'includes' && is_array($text)) {
                    $translatedArray = [];
                    foreach ($text as $item) {
                        if (!empty(trim($item))) {
                            $translatedItem = $translationService->autoTranslate(trim($item), 'es', 'en');
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
                        Log::info("Translating field: {$field}", [
                            'original_length' => strlen($plainText),
                            'preview' => substr($plainText, 0, 50)
                        ]);
                        
                        $translated = $translationService->autoTranslate($plainText, 'es', 'en');
                        
                        // Only save if translation is different from original
                        if ($translated && $translated !== $plainText && trim($translated) !== trim($plainText)) {
                            Log::info("Translation successful for field: {$field}", [
                                'original' => substr($plainText, 0, 50),
                                'translated' => substr($translated, 0, 50)
                            ]);
                            $translations[$field] = $translated;
                        } else {
                            Log::warning("Translation failed for field: {$field} - returned same text", [
                                'original' => substr($plainText, 0, 100),
                                'translated' => substr($translated ?? 'null', 0, 100),
                                'are_equal' => ($translated === $plainText)
                            ]);
                        }
                    }
                }
            }
            
            return response()->json([
                'success' => true,
                'translations' => $translations
            ]);
        } catch (\Exception $e) {
            Log::error('Translation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Translation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get model instance for translation (override in controller)
     */
    protected function getModelForTranslation($id)
    {
        // Override this method in each controller
        return null;
    }

    /**
     * Get translatable fields for the model (override in controller)
     */
    protected function getTranslatableFieldsForModel($model)
    {
        // Override this method in each controller
        return [];
    }
}


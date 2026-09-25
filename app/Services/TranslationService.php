<?php

namespace App\Services;

use App\Models\Translation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    /**
     * Get translated content for a model field
     * 
     * @param mixed $model
     * @param string $fieldName
     * @param string|null $locale
     * @return string|null
     */
    public function get($model, $fieldName, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        
        if (!method_exists($model, 'translations')) {
            return $model->getAttribute($fieldName);
        }

        $translation = $model->translations()
            ->where('locale', $locale)
            ->where('field_name', $fieldName)
            ->first();

        if ($translation && $translation->value) {
            // Check if value is JSON (for array fields like includes)
            $decoded = json_decode($translation->value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
            return $translation->value;
        }

        // Fallback to original value
        $originalValue = $model->getAttribute($fieldName);
        
        // If original is an array (like includes), return as-is
        if (is_array($originalValue)) {
            return $originalValue;
        }
        
        return $originalValue;
    }

    /**
     * Save translation for a model field
     * 
     * @param mixed $model
     * @param string $fieldName
     * @param string|array $value
     * @param string|null $locale
     * @return Translation
     */
    public function save($model, $fieldName, $value, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        
        // Handle array values (like includes) - store as JSON
        if (is_array($value)) {
            $value = json_encode($value);
        }
        
        return Translation::updateOrCreate(
            [
                'translatable_type' => get_class($model),
                'translatable_id' => $model->id,
                'locale' => $locale,
                'field_name' => $fieldName,
            ],
            [
                'value' => $value,
            ]
        );
    }

    /**
     * Save multiple translations at once
     * 
     * @param mixed $model
     * @param array $translations Array of ['field_name' => ['locale' => 'value']]
     * @return void
     */
    public function saveMultiple($model, array $translations)
    {
        foreach ($translations as $fieldName => $localeValues) {
            if (is_array($localeValues)) {
                foreach ($localeValues as $locale => $value) {
                    if (!empty($value)) {
                        $this->save($model, $fieldName, $value, $locale);
                    }
                }
            }
        }
    }

    /**
     * Save translations from request data
     * Handles format like: translations[heading][en], translations[heading][es]
     * 
     * @param mixed $model
     * @param array $requestData
     * @return void
     */
    public function saveFromRequest($model, array $requestData)
    {
        if (!isset($requestData['translations']) || !is_array($requestData['translations'])) {
            return;
        }

        foreach ($requestData['translations'] as $fieldName => $localeValues) {
            if (is_array($localeValues)) {
                foreach ($localeValues as $locale => $value) {
                    if (!empty($value)) {
                        $this->save($model, $fieldName, $value, $locale);
                    }
                }
            }
        }
    }

    /**
     * Get all translations for a model
     * 
     * @param mixed $model
     * @param string|null $locale
     * @return \Illuminate\Support\Collection
     */
    public function getAll($model, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        
        return Translation::where('translatable_type', get_class($model))
            ->where('translatable_id', $model->id)
            ->where('locale', $locale)
            ->pluck('value', 'field_name');
    }

    /**
     * Delete translation for a field
     * 
     * @param mixed $model
     * @param string $fieldName
     * @param string|null $locale
     * @return bool
     */
    public function delete($model, $fieldName, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        
        return Translation::where('translatable_type', get_class($model))
            ->where('translatable_id', $model->id)
            ->where('locale', $locale)
            ->where('field_name', $fieldName)
            ->delete();
    }

    /**
     * Delete all translations for a model
     * 
     * @param mixed $model
     * @return bool
     */
    public function deleteAll($model)
    {
        return Translation::where('translatable_type', get_class($model))
            ->where('translatable_id', $model->id)
            ->delete();
    }

    /**
     * Auto-translate using Google Translate API
     * 
     * @param string $text
     * @param string $targetLocale
     * @param string $sourceLocale
     * @return string
     */
    public function autoTranslate($text, $targetLocale, $sourceLocale = 'en')
    {
        if (empty($text)) {
            return $text;
        }

        // If source and target are the same, return original
        if ($sourceLocale === $targetLocale) {
            return $text;
        }

        try {
            // Map locale codes to Google Translate language codes
            $languageMap = [
                'en' => 'en',
                'es' => 'es',
            ];

            $sourceLang = $languageMap[$sourceLocale] ?? 'en';
            $targetLang = $languageMap[$targetLocale] ?? 'es';

            // Strip HTML tags but preserve structure for better translation
            $plainText = strip_tags($text);
            if (empty(trim($plainText))) {
                return $text;
            }

            // Use direct HTTP method first (more reliable than package)
            $translated = $this->translateAlternative($plainText, $targetLang, $sourceLang);
            
            // Check if translation actually happened
            if ($translated && $translated !== $plainText && $translated !== $text && strlen($translated) > 0) {
                Log::info('Direct HTTP translation successful', [
                    'original' => substr($plainText, 0, 50),
                    'translated' => substr($translated, 0, 50)
                ]);
                return $translated;
            }

            // Fallback to package method if direct HTTP failed
            try {
                $tr = new \Stichoza\GoogleTranslate\GoogleTranslate();
                $tr->setSource($sourceLang);
                $tr->setTarget($targetLang);
                
                // Translate the text with error handling
                $packageTranslation = $tr->translate($plainText);
                
                // Check if translation actually happened
                if ($packageTranslation && $packageTranslation !== $plainText && $packageTranslation !== $text && strlen($packageTranslation) > 0) {
                    Log::info('Package translation successful', [
                        'original' => substr($plainText, 0, 50),
                        'translated' => substr($packageTranslation, 0, 50)
                    ]);
                    return $packageTranslation;
                } else {
                    Log::warning('Package translation returned same text', [
                        'original' => substr($plainText, 0, 50),
                        'translated' => substr($packageTranslation ?? 'null', 0, 50)
                    ]);
                }
            } catch (\Exception $packageException) {
                Log::warning('Package translation method failed: ' . $packageException->getMessage());
            }
            
            // If both methods failed, return original
            Log::error('All translation methods failed, returning original text');
            return $text;
        } catch (\Exception $e) {
            // If translation fails, log and try alternative
            Log::error('Translation failed: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->translateAlternative($text, $targetLang ?? 'es', $sourceLang ?? 'en');
        }
    }

    /**
     * Alternative translation method using HTTP request
     */
    protected function translateAlternative($text, $targetLang, $sourceLang)
    {
        try {
            $url = 'https://translate.googleapis.com/translate_a/single';
            $params = [
                'client' => 'gtx',
                'sl' => $sourceLang,
                'tl' => $targetLang,
                'dt' => 't',
                'q' => $text
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');

            $response = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);

            if ($error) {
                Log::error('CURL Translation error: ' . $error);
                return $text;
            }

            if (empty($response)) {
                Log::warning('Empty response from translation API');
                return $text;
            }

            $result = json_decode($response, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('JSON decode error: ' . json_last_error_msg(), ['response' => substr($response, 0, 200)]);
                return $text;
            }
            
            // Parse response: [[["translated","original",...],...],...]
            if (isset($result[0]) && is_array($result[0]) && count($result[0]) > 0) {
                $translated = '';
                foreach ($result[0] as $item) {
                    // Each item is: ["translated_text", "original_text", ...]
                    if (isset($item[0]) && is_string($item[0])) {
                        $translated .= $item[0];
                    }
                }
                
                // Clean up the translation
                $translated = trim($translated);
                
                // Verify translation is different and meaningful
                if (!empty($translated) && $translated !== $text && $translated !== trim($text)) {
                    Log::info('Direct HTTP translation successful', [
                        'original' => substr($text, 0, 100),
                        'translated' => substr($translated, 0, 100),
                        'original_length' => strlen($text),
                        'translated_length' => strlen($translated)
                    ]);
                    return $translated;
                } else {
                    Log::warning('Translation returned same or empty text', [
                        'original' => substr($text, 0, 100),
                        'translated' => substr($translated, 0, 100),
                        'are_equal' => ($translated === $text),
                        'translated_empty' => empty($translated)
                    ]);
                }
            } else {
                Log::warning('Unexpected response format from translation API', [
                    'response_preview' => substr($response, 0, 500),
                    'has_result_0' => isset($result[0]),
                    'result_0_type' => isset($result[0]) ? gettype($result[0]) : 'not_set',
                    'result_0_count' => isset($result[0]) && is_array($result[0]) ? count($result[0]) : 'not_array'
                ]);
            }

            Log::warning('Alternative translation failed, returning original');
            return $text;
        } catch (\Exception $e) {
            Log::error('Alternative translation failed: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return $text;
        }
    }

    /**
     * Auto-translate all fields for a model
     * 
     * @param mixed $model
     * @param array $fields
     * @param string $targetLocale
     * @param string $sourceLocale
     * @return array
     */
    public function autoTranslateModel($model, array $fields, $targetLocale = 'es', $sourceLocale = 'en')
    {
        $translations = [];
        
        foreach ($fields as $field) {
            $originalValue = $model->getAttribute($field);
            if (!empty($originalValue)) {
                $translations[$field] = $this->autoTranslate($originalValue, $targetLocale, $sourceLocale);
            }
        }
        
        return $translations;
    }

    /**
     * Get available locales
     * 
     * @return array
     */
    public function getAvailableLocales()
    {
        return array_keys(config('app.available_locales', []));
    }
}


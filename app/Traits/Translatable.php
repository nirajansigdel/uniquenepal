<?php

namespace App\Traits;

use App\Models\Translation;
use Illuminate\Support\Facades\App;

trait Translatable
{
    /**
     * Get all translations for this model
     */
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Get translated value for a field
     * 
     * @param string $fieldName
     * @param string|null $locale
     * @return string|null
     */
    public function getTranslated($fieldName, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        
        $translation = $this->translations()
            ->where('locale', $locale)
            ->where('field_name', $fieldName)
            ->first();

        // If translation exists, return it
        if ($translation && $translation->value) {
            // Check if value is JSON (for array fields like includes)
            $decoded = json_decode($translation->value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
            return $translation->value;
        }

        // Fallback to original field value if no translation exists
        return $this->getAttribute($fieldName);
    }

    /**
     * Set translation for a field
     * 
     * @param string $fieldName
     * @param string $value
     * @param string|null $locale
     * @return Translation
     */
    public function setTranslation($fieldName, $value, $locale = null)
    {
        $locale = $locale ?? App::getLocale();

        return $this->translations()->updateOrCreate(
            [
                'locale' => $locale,
                'field_name' => $fieldName,
            ],
            [
                'value' => $value,
            ]
        );
    }

    /**
     * Set multiple translations at once
     * 
     * @param array $translations Array of ['field_name' => ['locale' => 'value']]
     * @return void
     */
    public function setTranslations(array $translations)
    {
        foreach ($translations as $fieldName => $localeValues) {
            if (is_array($localeValues)) {
                foreach ($localeValues as $locale => $value) {
                    if (!empty($value)) {
                        $this->setTranslation($fieldName, $value, $locale);
                    }
                }
            }
        }
    }

    /**
     * Get all translations for a specific locale
     * 
     * @param string|null $locale
     * @return \Illuminate\Support\Collection
     */
    public function getTranslationsForLocale($locale = null)
    {
        $locale = $locale ?? App::getLocale();
        
        return $this->translations()
            ->where('locale', $locale)
            ->pluck('value', 'field_name');
    }

    /**
     * Delete translation for a field
     * 
     * @param string $fieldName
     * @param string|null $locale
     * @return bool
     */
    public function deleteTranslation($fieldName, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        
        return $this->translations()
            ->where('locale', $locale)
            ->where('field_name', $fieldName)
            ->delete();
    }

    /**
     * Delete all translations for this model
     * 
     * @return bool
     */
    public function deleteAllTranslations()
    {
        return $this->translations()->delete();
    }

    /**
     * Magic method to get translated attribute
     * Usage: $model->translated_heading or $model->translatedContent
     */
    public function __get($key)
    {
        // Check if it's a translated field request
        if (strpos($key, 'translated_') === 0) {
            $fieldName = substr($key, 11); // Remove 'translated_' prefix
            return $this->getTranslated($fieldName);
        }

        return parent::__get($key);
    }
}


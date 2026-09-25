<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'translatable_type',
        'translatable_id',
        'locale',
        'field_name',
        'value',
    ];

    /**
     * Get the parent translatable model.
     */
    public function translatable()
    {
        return $this->morphTo();
    }

    /**
     * Scope to filter by locale
     */
    public function scopeForLocale($query, $locale)
    {
        return $query->where('locale', $locale);
    }

    /**
     * Scope to filter by field name
     */
    public function scopeForField($query, $fieldName)
    {
        return $query->where('field_name', $fieldName);
    }
}

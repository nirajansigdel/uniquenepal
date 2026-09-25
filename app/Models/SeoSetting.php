<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'schema_json',
        'heading_h1',
        'image_description',
    ];

    protected $casts = [
        'meta_title' => 'array',
        'meta_description' => 'array',
        'meta_keywords' => 'array',
        'canonical_url' => 'array',
        'schema_json' => 'array',
        'heading_h1' => 'array',
        'image_description' => 'array',
    ];
}

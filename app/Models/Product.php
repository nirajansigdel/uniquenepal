<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'country_id',
        'heading',
        'subtitle',
        'date',
        'duration',
        'people',
        'package',
        'original_price',
        'discounted_price',
        'location',
        'transportation',
        'content',
        'images',
        'videos',
        'product_types',
        'includes',
        'excludes',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'people' => 'integer',
        'product_types' => 'array',
        'images' => 'array',
        'videos' => 'array',
        'includes' => 'array',
        'excludes' => 'array',
        'status' => 'boolean',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function comments()
    {
        return $this->hasMany(ProductComment::class)->latest();
    }

    /**
     * Portable filter for product_types that works on servers without JSON support.
     * Matches the JSON-encoded text for a given type, e.g. ["Destination","Group"].
     */
    public function scopeHasType($query, string $type)
    {
        // Use LIKE against the stored JSON string (works if column is JSON or TEXT)
        return $query->where('product_types', 'LIKE', '%"'.$type.'"%');
    }
}

<?php
namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverImage extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'title',
        'image'
    ];

    // ✅ Add this to fix array-to-string conversion error
    protected $casts = [
        'image' => 'array',
    ];
}

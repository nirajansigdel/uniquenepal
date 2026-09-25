<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class NavigateItem extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link',
        'position',
        'show_everest',
        'show_annapurna',
        'show_langtang',
        'show_poonhill',
        'show_adventure',
        'show_activities',
        'status',
    ];

    protected $casts = [
        'show_everest' => 'boolean',
        'show_annapurna' => 'boolean',
        'show_langtang' => 'boolean',
        'show_poonhill' => 'boolean',
        'show_adventure' => 'boolean',
        'show_activities' => 'boolean',
        'status' => 'boolean',
        'position' => 'integer',
    ];
}



<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyUs extends Model
{
    use HasFactory, Translatable;

    protected $table = 'why_us';

    protected $fillable = [
        'heading',
        'subtitle',
        'content',
        'image',
    ];
}

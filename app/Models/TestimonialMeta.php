<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialMeta extends Model
{
    use HasFactory;

    protected $table = 'testimonial_metas';

    protected $fillable = [
        'title',
        'description',
    ];
}

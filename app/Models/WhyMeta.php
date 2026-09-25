<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyMeta extends Model
{
    use HasFactory;

    protected $table = 'why_metas';

    protected $fillable = [
        'title',
        'description',
    ];
}

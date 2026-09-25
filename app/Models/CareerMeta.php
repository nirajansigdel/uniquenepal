<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerMeta extends Model
{
    use HasFactory;

    protected $table = 'career_metas';

    protected $fillable = [
        'title',
        'description',
    ];
}

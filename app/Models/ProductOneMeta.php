<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOneMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];
}

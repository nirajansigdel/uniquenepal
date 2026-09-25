<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutMeta extends Model
{
    use HasFactory;

    protected $table = 'about_metas';

    protected $fillable = [
        'title',
        'description',
    ];
}

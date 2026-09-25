<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorMessage extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'name',
        'position',
        'companyName',
        'image',
        'message',
    ];
}

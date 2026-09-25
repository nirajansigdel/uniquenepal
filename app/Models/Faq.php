<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, Translatable;

    // Only include columns that exist in the 'faqs' table
    protected $fillable = ['question', 'answer'];
}

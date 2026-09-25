<?php

namespace App\Models;

use App\Models\WorkCategory;
use App\Models\Company;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory, Translatable;
    protected $fillable = ['name', 'company_id', 'work_category_id', 'image', 'description'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function work_category()
    {
        return $this->belongsTo(WorkCategory::class, 'work_category_id');
    }
}

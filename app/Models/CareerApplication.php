<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'full_name',
        'email',
        'phone',
        'availability',
        'why_volunteer',
        'cv_resume',
        'academic_certificates',
        'additional_documents',
        'status',
        'admin_notes'
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function getStatusBadgeAttribute()
    {
        // Always return the same badge for "Completed" status
        return 'badge-success';
    }

    public function getStatusTextAttribute()
    {
        // Always display "Completed" regardless of actual status
        return 'Completed';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'userdetails';

    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'phone_no',
        'email',
        'address',
        'whatsapp_no',
        'document_proof',
        'date_of_birth',
        'nationality',
        'passport_number',
        'passport_expiry',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'medical_conditions',
        'allergies',
        'medications',
        'dietary_restrictions',
        'special_requirements',
        'preferred_accommodation',
        'document_proof',
        'passport_copy',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'passport_expiry' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor for document proof types
    public function getDocumentProofTypesAttribute()
    {
        return [
            'driving_license' => 'Driving License',
            'citizenship' => 'Citizenship',
            'passport' => 'Passport',
            'national_id' => 'National ID',
            'other' => 'Other Valid Proof'
        ];
    }

    // Accessor for status labels
    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'completed' => 'Completed'
        ][$this->status] ?? 'Unknown';
    }
}

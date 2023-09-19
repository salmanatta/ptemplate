<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HPCardiacTemplateNurse extends Model
{
    use HasFactory;

    protected $casts = [
        'allergies' => 'array',
        'nutrition_assessment' => 'array',
    ];

    public function patient()
    {
       return $this->belongsTo(Patient::class,'patient_id','id');
    }
}

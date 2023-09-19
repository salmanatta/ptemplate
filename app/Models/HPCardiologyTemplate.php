<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HPCardiologyTemplate extends Model
{
    use HasFactory;

    protected $casts =[
        'procedure_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
}

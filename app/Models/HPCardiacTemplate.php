<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HPCardiacTemplate extends Model
{
    use HasFactory;

    public function patient()
    {
       return $this->belongsTo(Patient::class,'patient_id','id');
    }
}

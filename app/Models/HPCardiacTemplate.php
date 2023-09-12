<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HPCardiacTemplate extends Model
{
    use HasFactory;

    protected $casts = [
        'mi_date' => 'date',
        'pci_date' => 'date',
        'previous_cabg_date' => 'date',
        'previous_valve_date' => 'date',
        'echo_date' => 'date',
        'cardiac_cath_date' => 'date',
        'tentative_date_procedure' => 'date',
    ];

    public function patient()
    {
       return $this->belongsTo(Patient::class,'patient_id','id');
    }
}

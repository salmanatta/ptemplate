<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public function country() {
        return $this->belongsTo(Country::class , 'country_id' , 'id');
    }
    public function city() {
        return $this->belongsTo(City::class , 'city_id' , 'id');
    }
    public function province() {
        return $this->belongsTo(Province::class , 'province_id' , 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function hpcardiac(){
        return $this->hasMany(HPCardiacTemplate::class , 'patient_id','id');
    }

}

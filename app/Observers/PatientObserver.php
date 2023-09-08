<?php

namespace App\Observers;

use App\Models\Patient;

class PatientObserver
{
    /**
     * Handle the patient "created" event.
     *
     * @param  \App\Models\patient  $patient
     * @return void
     */
    public function created(Patient $patient)
    {
        $patient->mr_no = str_pad($patient->id, 13, "0" , STR_PAD_LEFT);
        $patient->save();
    }

    /**
     * Handle the patient "updated" event.
     *
     * @param  \App\Models\patient  $patient
     * @return void
     */
    public function updated(Patient $patient)
    {
        //
    }

    /**
     * Handle the patient "deleted" event.
     *
     * @param  \App\Models\patient  $patient
     * @return void
     */
    public function deleted(Patient $patient)
    {
        //
    }

    /**
     * Handle the patient "restored" event.
     *
     * @param  \App\Models\patient  $patient
     * @return void
     */
    public function restored(Patient $patient)
    {
        //
    }

    /**
     * Handle the patient "force deleted" event.
     *
     * @param  \App\Models\patient  $patient
     * @return void
     */
    public function forceDeleted(Patient $patient)
    {
        //
    }
}

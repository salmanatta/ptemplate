<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_p_cardiac_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->boolean('dm')->default(false)->nullable();
            $table->boolean('htn')->default(false)->nullable();
            $table->boolean('cva')->default(false)->nullable();
            $table->boolean('smoking')->default(false)->nullable();
            $table->boolean('pad')->default(false)->nullable();
            $table->boolean('dyslipidemia')->default(false)->nullable();
            $table->string('elevated_creatinine')->nullable();
            $table->string('css_class')->nullable();
            $table->string('nyha_class')->nullable();
            $table->date('mi_date')->nullable();
            $table->date('pci_date')->nullable();
            $table->date('previous_cabg_date')->nullable();
            $table->date('previous_valve_date')->nullable();
            $table->string('past_medical_history_others')->nullable();
            $table->string('general_examination')->nullable();
            $table->string('cvs')->nullable();
            $table->string('chest')->nullable();
            $table->string('extremities')->nullable();
            $table->string('systemic_examination_others')->nullable();
            $table->string('inr')->nullable();
            $table->string('hba1c')->nullable();
            $table->string('tag')->nullable();
            $table->string('hdl')->nullable();
            $table->string('ldl')->nullable();
            $table->string('cholestrol')->nullable();
            $table->string('chest_xray')->nullable();
            $table->string('ecg')->nullable();
            $table->date('echo_date')->nullable();
            $table->string('lvef')->nullable();
            $table->date('cardiac_cath_date')->nullable();
            $table->string('cardiac_cath_findings')->nullable();
            $table->string('carotid_duplex_left')->nullable();
            $table->string('carotid_duplex_right')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('management_plan')->nullable();
            $table->date('tentative_date_procedure')->nullable();
            $table->string('followup_visit')->nullable();
            $table->boolean('patient_education')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('h_p_cardiac_templates');
    }
};

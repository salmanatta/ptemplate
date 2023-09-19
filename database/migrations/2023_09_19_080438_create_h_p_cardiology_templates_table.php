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
        Schema::create('h_p_cardiology_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('past_medical_history')->nullable();
            $table->string('css_class')->nullable();
            $table->string('general_examination')->nullable();
            $table->string('cvc')->nullable();
            $table->string('chest')->nullable();
            $table->string('abdomen')->nullable();
            $table->string('extremities')->nullable();
            $table->string('neuro')->nullable();
            $table->string('investigation')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('management_plan')->nullable();
            $table->date('procedure_date')->nullable();
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
        Schema::dropIfExists('h_p_cardiology_templates');
    }
};

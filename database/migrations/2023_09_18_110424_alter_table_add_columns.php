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
        Schema::table('h_p_cardiac_template_nurses', function (Blueprint $table) {
            $table->string('history_present_complain')->nullable();
            $table->json('allergies')->nullable();
            $table->string('current_medication')->nullable();
            $table->string('martial_status')->nullable();
            $table->integer('no_of_children')->nullable();
            $table->string('employed')->nullable();
            $table->string('psychological_issues')->nullable();
            $table->string('addictions')->nullable();
            $table->string('religion')->nullable();
            $table->boolean('privacy')->default(false);
            $table->boolean('food')->default(false);
            $table->boolean('male_refusal')->default(false);
            $table->string('others')->nullable();
            $table->json('nutrition_assessment')->nullable();
            $table->integer('nutrition_assessment_score')->nullable();
            $table->boolean('dietitian_referral_required')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('h_p_cardiac_template_nurses', function (Blueprint $table) {
            //
        });
    }
};

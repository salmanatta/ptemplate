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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('phone')->unique();
            $table->char('country_code' , 4)->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(false)->comment('User Account Status 1= active, 2 is not active');
            $table->char('current_level', 50)->nullable()->comment('It will represent the user current level');
            $table->float('current_progress')->nullable()->comment('Overall progress');
            $table->string('type')->comment('User type will be maintained here like ADMIN, USER etc');
            $table->boolean('is_verified')->default(false)->comment('User is Verified');
            $table->char('language' , 1)->default(2)->comment('1 for English, 2 for Arabic');
            $table->dateTime('last_activity')->nullable()->comment('user last activity');
            $table->integer('otp')->nullable();
            $table->string('password')->nullable();
            $table->json('notifications_preferences')->nullable()->comment('All modules with Notifications enabled will be maintained here');
            $table->string('ip_address')->nullable()->comment('Maintaining the user IP address');
            $table->date('personal_dob')->nullable()->comment('User Date of Birth');
            $table->string('personal_national_id')->nullable();
            $table->string('personal_marital_status')->nullable();
            $table->string('personal_dependents')->nullable();
            $table->string('personal_education_level')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('employment_employer_name')->nullable();
            $table->string('employment_industry')->nullable();
            $table->string('employment_position')->nullable();
            $table->string('employment_address')->nullable();
            $table->string('financial_annual_net_income')->nullable();
            $table->string('financial_net_worth')->nullable();
            $table->string('financial_liquid_net_worth')->nullable();
            $table->string('financial_capital_to_be_invested')->nullable();
            $table->string('financial_source_of_wealth')->nullable();
            $table->string('investment_knowledge')->nullable();
            $table->string('investment_objective')->nullable();
            $table->string('investment_period')->nullable();
            $table->string('investment_period_recover')->nullable();
            $table->boolean('is_tester')->default(false);
            $table->json('old_numbers')->nullable()->comment('Maintain the old numbers for user');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('current_level')->references('id')->on('levels')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

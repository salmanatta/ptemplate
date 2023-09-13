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
        Schema::table('h_p_cardiac_templates', function (Blueprint $table) {
            $table->json('risk_factor')->nullable();
            $table->dropColumn(['dm','htn','cva','smoking','pad','dyslipidemia']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('h_p_cardiac_templates', function (Blueprint $table) {
        });
    }
};

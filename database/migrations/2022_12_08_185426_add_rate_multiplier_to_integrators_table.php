<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRateMultiplierToIntegratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('integrators', function (Blueprint $table) {
            $table->float('rate_multiplier',2,1)->default(1)->after('logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('integrators', function (Blueprint $table) {
            $table->dropColumn('rate_multiplier');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transit_rates', function (Blueprint $table) {
            $table->index('zone_id');
            $table->index('weight');
        });
        Schema::table('export_rates', function (Blueprint $table) {
            $table->index('zone_id');
            $table->index('weight');
        });
        Schema::table('import_rates', function (Blueprint $table) {
            $table->index('zone_id');
            $table->index('weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transit_rates', function (Blueprint $table) {
            $table->dropIndex('zone_id');
            $table->dropIndex('weight');
        });
        Schema::table('export_rates', function (Blueprint $table) {
            $table->dropIndex('zone_id');
            $table->dropIndex('weight');
        });
        Schema::table('import_rates', function (Blueprint $table) {
            $table->dropIndex('zone_id');
            $table->dropIndex('weight');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZoneCodeToExportRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('export_rates', function (Blueprint $table) {
            $table->string('zone_code')->after('zone_id');
        });
        Schema::table('import_rates', function (Blueprint $table) {
            $table->string('zone_code')->after('zone_id');
        });
        Schema::table('transit_rates', function (Blueprint $table) {
            $table->string('zone_code')->after('zone_id');
        });
        Schema::table('over_weight_rates', function (Blueprint $table) {
            $table->string('zone_code')->after('zone_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('export_rates', function (Blueprint $table) {
            $table->dropColumn('zone_code');
        });
        Schema::table('import_rates', function (Blueprint $table) {
            $table->dropColumn('zone_code');
        });
        Schema::table('transit_rates', function (Blueprint $table) {
            $table->dropColumn('zone_code');
        });
        Schema::table('over_weight_rates', function (Blueprint $table) {
            $table->dropColumn('zone_code');
        });
    }
}

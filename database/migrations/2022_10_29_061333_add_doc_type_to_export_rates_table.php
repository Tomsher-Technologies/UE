<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocTypeToExportRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_rates', function (Blueprint $table) {
            $table->string('pack_type')->default('package')->after('zone_id');
        });
        Schema::table('export_rates', function (Blueprint $table) {
            $table->string('pack_type')->default('package')->after('zone_id');
        });
        Schema::table('transit_rates', function (Blueprint $table) {
            $table->string('pack_type')->default('package')->after('zone_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_rates', function (Blueprint $table) {
            $table->dropColumn('pack_type');
        });
        Schema::table('export_rates', function (Blueprint $table) {
            $table->dropColumn('pack_type');
        });
        Schema::table('transit_rates', function (Blueprint $table) {
            $table->dropColumn('pack_type');
        });
    }
}

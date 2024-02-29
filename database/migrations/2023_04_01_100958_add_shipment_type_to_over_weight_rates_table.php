<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShipmentTypeToOverWeightRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('over_weight_rates', function (Blueprint $table) {
            $table->string('shipment_type')->nullable()->after('pack_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('over_weight_rates', function (Blueprint $table) {
            $table->dropColumn('shipment_type');
        });
    }
}

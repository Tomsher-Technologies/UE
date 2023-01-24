<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProfitMarginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profit_margins', function (Blueprint $table) {
            $table->string('product_type')->nullable()->after('integrator_id');
            $table->string('applied_for_country')->nullable()->after('applied_for_id');
            $table->dateTime('start_date')->nullable()->after('rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profit_margins', function (Blueprint $table) {
            $table->dropColumn('product_type');
            $table->dropColumn('start_date');
            $table->dropColumn('applied_for_country');
        });
    }
}

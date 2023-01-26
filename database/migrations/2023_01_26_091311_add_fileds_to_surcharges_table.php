<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiledsToSurchargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surcharges', function (Blueprint $table) {
            $table->boolean('per_weight')->default(false)->after('applied_for_id');
            $table->integer('sort_order')->default(0)->after('per_weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surcharges', function (Blueprint $table) {
            $table->dropColumn('per_weight');
            $table->dropColumn('sort_order');
        });
    }
}

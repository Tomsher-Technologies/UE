<?php

use App\Models\Integrators\Integrator;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSurchargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surcharges', function (Blueprint $table) {
            $table->foreignIdFor(Integrator::class)->after('rate_type');
            $table->float('start_weight', 10, 4)->after('integrator_id');
            $table->float('end_weight', 10, 4)->after('start_weight');
            $table->string('applied_for')->after('end_weight');
            $table->text('applied_for_id')->after('applied_for');
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
            $table->dropColumn('integrator_id');
            $table->dropColumn('end_weight');
            $table->dropColumn('start_weight');
            $table->dropColumn('applied_for');
            $table->dropColumn('applied_for_id');
        });
    }
}

<?php

use App\Models\Integrators\Integrator;
use App\Models\Zones\Zone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverWeightRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_weight_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Integrator::class);
            $table->foreignIdFor(Zone::class);
            $table->float('from_weight', 10, 4);
            $table->float('end_weight', 10, 4);
            $table->float('rate', 10, 4);
            $table->string('pack_type')->default('package');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('over_weight_rates');
    }
}

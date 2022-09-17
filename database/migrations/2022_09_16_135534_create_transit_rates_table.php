<?php

use App\Models\Integrators\Integrator;
use App\Models\Zones\Zone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransitRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transit_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Integrator::class);
            $table->foreignIdFor(Zone::class);
            $table->float('weight', 10, 4);
            $table->float('rate', 10, 4);
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
        Schema::dropIfExists('transit_rates');
    }
}

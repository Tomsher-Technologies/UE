<?php

use App\Models\Integrators\Integrator;
use App\Models\Zones\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdPincodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('od_pincodes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Integrator::class);
            $table->foreignIdFor(Country::class);
            $table->string('pincode');
            $table->float('rate', 6, 2);
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
        Schema::dropIfExists('od_pincodes');
    }
}

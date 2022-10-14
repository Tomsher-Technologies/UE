<?php

use App\Models\Integrators\Integrator;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitMarginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_margins', function (Blueprint $table) {
            $table->id();
            $table->string('profitmargin_type');
            $table->integer('profitmargin_id');
            $table->string('type');
            $table->foreignIdFor(Integrator::class);
            $table->string('applied_for');
            $table->integer('applied_for_id');
            $table->double('weight', 10, 2);
            $table->string('rate_type');
            $table->double('rate', 10, 2);
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
        Schema::dropIfExists('profit_margins');
    }
}

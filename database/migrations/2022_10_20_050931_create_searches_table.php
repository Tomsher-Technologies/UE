<?php

use App\Models\User;
use App\Models\Zones\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Country::class, 'from_country');
            $table->string('from_city')->nullable();
            $table->string('from_pin')->nullable();
            $table->foreignIdFor(Country::class, 'to_country');
            $table->string('to_city')->nullable();
            $table->string('to_pin')->nullable();
            $table->integer('number_of_pieces')->nullable();
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
        Schema::dropIfExists('searches');
    }
}

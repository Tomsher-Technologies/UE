<?php

use App\Models\Orders\Search;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Search::class);
            $table->float('length', 10, 4)->nullable();
            $table->float('height', 10, 4)->nullable();
            $table->float('width', 10, 4)->nullable();
            $table->float('weight', 10, 4);
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
        Schema::dropIfExists('search_items');
    }
}

<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->float('msp', 8, 2)->nullable();
            $table->string('msp_type')->nullable();
            $table->float('profit_margin', 8, 2)->nullable();
            $table->string('profit_margin_type')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('customer_details');
    }
}

<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name')->nullable();
            $table->float('request_rate', 6, 2)->nullable();
            $table->float('approved_rate', 6, 2)->nullable();
            $table->integer('rate_type')->default(1)->comment('1=>fixed amount, 2=>percentage');
            $table->timestamp('request_date')->useCurrent();
            $table->timestamp('approval_date')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=> pending,1=>approved, 2=>rejected, 3=>expired');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_rates');
    }
}

<?php

use App\Models\Integrators\Integrator;
use App\Models\Orders\Search;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Integrator::class);
            $table->foreignIdFor(Search::class);
            
            $table->string('shipper_name');
            $table->string('shipper_phone');
            $table->string('shipper_address');

            $table->string('consignee_name');
            $table->string('consignee_email');
            $table->string('consignee_phone');
            $table->string('consignee_address');
            $table->string('consignee_town');
            $table->string('consignee_province');

            $table->string('item_name');

            $table->string('hawbNumber');
            $table->string('invoice_url');

            $table->boolean('order_status')->default(0);
            
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
        Schema::dropIfExists('orders');
    }
}

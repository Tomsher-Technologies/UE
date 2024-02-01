<?php

use App\Models\Integrators\Integrator;
use App\Models\Orders\Search;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToSpecialRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('special_rates', function (Blueprint $table) {
            $table->foreignIdFor(Integrator::class)->after('user_id');
            $table->foreignIdFor(Search::class)->after('user_id');
            $table->float('total_weight', 10, 4)->after('integrator_id');
            $table->float('original_rate', 10, 4)->after('total_weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('special_rates', function (Blueprint $table) {
            $table->dropColumn('search_id');
            $table->dropColumn('integrator_id');
            $table->dropColumn('original_rate');
            $table->dropColumn('total_weight');
        });
    }
}

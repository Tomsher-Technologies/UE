<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->string('address_2')->nullable()->after('address');
            $table->string('city')->nullable()->after('address_2');
            $table->string('country')->nullable()->after('city');
            $table->string('vat_number')->nullable()->after('country');
            $table->string('account_number')->nullable()->after('vat_number');
            $table->string('company_name')->nullable()->after('account_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->dropColumn('address_2');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('vat_number');
            $table->dropColumn('account_number');
            $table->dropColumn('company_name');
        });
    }
}

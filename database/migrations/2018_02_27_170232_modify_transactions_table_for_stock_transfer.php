<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `transactions` CHANGE `type` `type` ENUM('purchase','sell', 'expense',
            'stock_adjustment', 'sell_transfer', 'purchase_transfer', 'opening_stock') DEFAULT NULL");

        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('transfer_parent_id')->nullable()->after('total_amount_recovered');
            $table->integer('opening_stock_product_id')->nullable()->after('transfer_parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};

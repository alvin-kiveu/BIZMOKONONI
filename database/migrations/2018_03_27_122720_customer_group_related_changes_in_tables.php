<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('contacts', function (Blueprint $table) {
            $table->integer('customer_group_id')->nullable()->after('is_default');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('customer_group_id')->nullable()->after('contact_id')->comment('used to add customer group while selling');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

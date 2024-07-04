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
            $table->string('custom_field1')->nullable()->after('customer_group_id');
            $table->string('custom_field2')->nullable()->after('custom_field1');
            $table->string('custom_field3')->nullable()->after('custom_field2');
            $table->string('custom_field4')->nullable()->after('custom_field3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            //
        });
    }
};

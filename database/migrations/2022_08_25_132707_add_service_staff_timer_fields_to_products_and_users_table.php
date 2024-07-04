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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('preparation_time_in_minutes')->nullable()->after('created_by');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('available_at')->nullable()->after('business_id')->comment('Service staff avilable at. Calculated from product preparation_time_in_minutes');
            $table->dateTime('paused_at')->nullable()->after('available_at')->comment('Service staff available time paused at, Will be nulled on resume.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_and_users', function (Blueprint $table) {
            //
        });
    }
};

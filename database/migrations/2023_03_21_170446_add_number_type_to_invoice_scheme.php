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
        Schema::table('invoice_schemes', function (Blueprint $table) {
            $table->string('number_type', 100)->default('sequential')->after('scheme_type');

            $table->index('number_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_schemes', function (Blueprint $table) {
            //
        });
    }
};

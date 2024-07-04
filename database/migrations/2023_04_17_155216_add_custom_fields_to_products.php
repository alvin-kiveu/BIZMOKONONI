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
            $table->string('product_custom_field5')->nullable()->after('product_custom_field4');
            $table->string('product_custom_field6')->nullable()->after('product_custom_field5');
            $table->string('product_custom_field7')->nullable()->after('product_custom_field6');
            $table->string('product_custom_field8')->nullable()->after('product_custom_field7');
            $table->string('product_custom_field9')->nullable()->after('product_custom_field8');
            $table->string('product_custom_field10')->nullable()->after('product_custom_field9');
            $table->string('product_custom_field11')->nullable()->after('product_custom_field10');
            $table->string('product_custom_field12')->nullable()->after('product_custom_field11');
            $table->string('product_custom_field13')->nullable()->after('product_custom_field12');
            $table->string('product_custom_field14')->nullable()->after('product_custom_field13');
            $table->string('product_custom_field15')->nullable()->after('product_custom_field14');
            $table->string('product_custom_field16')->nullable()->after('product_custom_field15');
            $table->string('product_custom_field17')->nullable()->after('product_custom_field16');
            $table->string('product_custom_field18')->nullable()->after('product_custom_field17');
            $table->string('product_custom_field19')->nullable()->after('product_custom_field18');
            $table->string('product_custom_field20')->nullable()->after('product_custom_field19');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};

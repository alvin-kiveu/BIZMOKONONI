<?php

use App\TransactionPayment;
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
        Schema::table('transaction_payments', function (Blueprint $table) {
            $table->integer('business_id')->after('transaction_id')->nullable();
        });

        $transaction_payments = TransactionPayment::with(['created_user'])->get();
        foreach ($transaction_payments as $transaction_payment) {
            $transaction_payment->business_id = $transaction_payment->created_user?->business_id;
            $transaction_payment->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_payments', function (Blueprint $table) {
            //
        });
    }
};

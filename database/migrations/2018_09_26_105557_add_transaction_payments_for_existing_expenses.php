<?php

use App\Transaction;
use App\TransactionPayment;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $expenses = Transaction::where('type', 'expense')
                                ->get();
        $transaction_payments = [];
        //create transaction payment
        foreach ($expenses as $expense) {
            if ($expense->payment_status == 'paid') {
                $transaction_payment = [
                    'transaction_id' => $expense->id,
                    'amount' => $expense->final_total,
                    'method' => 'cash',
                    'paid_on' => $expense->transaction_date,
                    'created_by' => $expense->created_by,
                ];
                $transaction_payments[] = $transaction_payment;
            }
        }

        if (! empty($transaction_payments)) {
            TransactionPayment::insert($transaction_payments);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};

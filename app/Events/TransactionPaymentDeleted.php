<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class TransactionPaymentDeleted
{
    use SerializesModels;

    public $transactionPayment;

    public $isDeleted;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($transactionPayment)
    {
        $this->transactionPayment = $transactionPayment;
        
        //used in accounting MapPaymentTransaction
        $this->isDeleted = true;
    }
}

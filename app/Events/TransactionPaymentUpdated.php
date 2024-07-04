<?php

namespace App\Events;

use App\TransactionPayment;
use Illuminate\Queue\SerializesModels;

class TransactionPaymentUpdated
{
    use SerializesModels;

    public $transactionPayment;

    public $transactionType;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TransactionPayment $transactionPayment, $transactionType)
    {
        $this->transactionPayment = $transactionPayment;
        $this->transactionType = $transactionType;
    }
}

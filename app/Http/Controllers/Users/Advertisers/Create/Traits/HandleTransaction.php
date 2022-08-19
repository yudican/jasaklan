<?php

namespace App\Http\Controllers\Users\Advertisers\Create\Traits;

use App\Models\Transaction;

trait HandleTransaction {
    public function storeTransaction($request, $amount)
    {
        $transaction = new Transaction();

        $transaction->fill([
            'user_id' => $request->user()->id,
            'type'    => Transaction::EXPENSES,
            'amount'  => (int) $amount,
        ]);

        $transaction->saveOrFail();

        $request->user()->decrement('balance', $amount);
    }
}

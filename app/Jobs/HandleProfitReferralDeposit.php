<?php

namespace App\Jobs;

use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleProfitReferralDeposit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $amount;
    public $referredId;

    public function __construct($amount, $referredId)
    {
        $this->amount = $amount;
        $this->referredId = $referredId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $bonus = Referral::DEPOSIT_BONUS_IN_PERCENT * $this->amount;

        User::where('id', $this->referredId)->increment('balance', $bonus);

        $transaction = new Transaction();

        $transaction->fill([
            'user_id' => $this->referredId,
            'type' => Transaction::INCOME,
            'amount' => $bonus,
            'status' => Transaction::SETTLE,
        ]);

        $transaction->saveOrFail();
    }
}

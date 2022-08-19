<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleWithdrawBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $userId;
    public $newBalance;

    public function __construct($userId, $newBalance)
    {
        $this->userId     =  $userId;
        $this->newBalance =  $newBalance;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::where('id', $this->userId)->update([
            'balance' => $this->newBalance,
        ]);
    }
}

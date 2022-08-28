<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckStatusAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:ads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tickets = Ticket::where('status', 'review')->get();
        foreach ($tickets as $key => $ticket) {
            $now = strtotime(Carbon::now());
            $end = strtotime(Carbon::parse($ticket->created_at)->addDays(7));

            if ($now > $end) {
                $number_of_views = $ticket->getAd->views + 1;
                $dataView = [
                    'views' => $number_of_views,
                    'status' => $number_of_views == 0 ? 'finish' : 'active',
                ];
                $ticket->getAd()->update($dataView);
                $ticket->update([
                    'status' => 'approve',
                ]);
            }
        }
        return 0;
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Award;
use App\Lib\Web3Helper;

class SendAward extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'award:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send user\'s award';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $web3_helper = new Web3Helper();
        $awards = Award::where('status', 0)->get();

        foreach ($awards as $award) {
            Log::info("Sending {$award->award_type} to {$award->address} - amount: {$award->amount}USDC");
            $web3_helper->sendTokenToUser($award->address, $award->amount);
            $award->status = 1;
            $award->save();
        }

        return 0;
    }
}

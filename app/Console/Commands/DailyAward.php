<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use \App\Models\TokenInfo;
use \App\Models\Award;

class DailyAward extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'award:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily award to NFT holders';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = now();
        $tokens = TokenInfo::all();

        $awards = [];
        foreach ($tokens as $token) {
            if ($token->purchase_time == null) continue;
            $diff = date_diff($now, $token->purchase_time);

            $amount = $this->getDailyAward($token->token_id, $diff->days);

            if ($amount === 0) continue;

            if (isset($awards[$token->owner])) {
                $awards[$token->owner] += $amount;
            } else {
                $awards[$token->owner] = $amount;
            }
        }

        Log::info("Daily award - {$now}");

        foreach ($awards as $owner => $amount) {
            Log::info("{$owner} will receive {$amount}USDC");
            Award::create([
                'address' => $owner,
                'amount' => $amount,
                'award_type' => 'Daily award'
            ]);
        }

        return 0;
    }

    function getDailyAward($token_id, $days) {
        if ($days >= 90) return 0;

        if ($token_id <= 125) {
            // pirate
            if ($days < 30 || ($days - 29) % 7 == 0) return 3;
        } else {
            // treasure
            if ($days < 20 || ($days - 19) % 7 == 0) return 1;
        }

        return 0;
    }
}

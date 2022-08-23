<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use phpseclib\Math\BigInteger;
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

        $nonce = $web3_helper->getNonce(config('web3.wallet.address'));

        foreach ($awards as $award) {
            Log::info("Sending {$award->award_type} to {$award->address} - amount: {$award->amount}USDC");
            $txHash = $web3_helper->sendTokenToUser($award->address, $award->amount, $nonce);
            $award->status = 1;
            $award->save();
            $nonce = $nonce->add(new BigInteger(1));
        }
        if ($txHash !== null) {
            $transaction = $web3_helper->confirmTx($txHash);
            if (!$transaction) {
                throw new Error('Transaction was not confirmed.');
            } else {
                echo 'Transaction confirmed' . "<br>\n";
            }
        }
      
        return 0;
    }
}

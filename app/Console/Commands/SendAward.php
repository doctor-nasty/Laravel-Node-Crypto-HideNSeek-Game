<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use phpseclib\Math\BigInteger;

use App\Models\Award;
use App\Models\NftAward;
use App\Models\TokenInfo;
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
        $this->processNftAward();
        $this->processTokenAward();
        return 0;
    }

    protected function processTokenAward() {
        $web3_helper = new Web3Helper();
        $awards = Award::where('status', 1)->get();

        foreach ($awards as $award) {
            $txInfo = $web3_helper->confirmTx($award->tx_hash);
            if ($txInfo->status == "0x1") {
                $award->status = 2;
                $award->save();
            } else if ($txInfo->status == '0x0') {
                $award->status = 0;
                $award->save();
            }
        }

        $awards = Award::where('status', '<>', 2)->get(); // get failed or new awards

        if (count($awards) == 0) return ;

        $balance = new BigInteger($web3_helper->getTokenBalance());

        $nonce = $web3_helper->getNonce(config('web3.wallet.address'));

        $txHash = null;
        $lastTx = null;

        foreach ($awards as $award) {
            Log::info("Sending {$award->award_type} to {$award->address} - amount: {$award->amount}USDC");

            $amount = new BigInteger($award->amount * 100);
            $amount = $amount->multiply(new BigInteger(config('web3.chain.token_unit')))->divide(new BigInteger(100))[0]; // decimals

            if ($balance->compare($amount) < 0) {
                break;
            }

            $balance = $balance->subtract($amount);

            $txHash = $web3_helper->sendTokenToUser($award->address, $amount, $nonce);

            if  ($txHash == null) break;

            $award->status = 1;
            $award->tx_hash = $txHash;
            $award->save();
            $nonce = $nonce->add(new BigInteger(1));
            $lastTx = $txHash;
        }

        if ($lastTx !== null) {
            Log::info("Waiting until last tx {$lastTx} is confirmed");
            $transaction = $web3_helper->confirmTx($lastTx);
            if (!$transaction) {
                throw new Error('Transaction was not confirmed.');
            } else {
                echo "Transaction confirmed\n";
            }
        } else {
            Log::info("No transactions are sent");
            echo ("No transactions are sent");
        }
        Log::info("SendAward ended");
    }

    protected function processNftAward() {
        $web3_helper = new Web3Helper();
        $awards = NftAward::where('status', 1)->get();

        foreach ($awards as $award) {
            $txInfo = $web3_helper->confirmTx($award->tx_hash);
            if ($txInfo->status == "0x1") {
                $award->status = 2;
                $award->save();
            }
        }

        $award = NftAward::where('status', '<>', 2)->first(); // get failed or new $awards

        if ($award == null) {
            Log::info('No pending NFT award.');
            return ;
        }

        $nonce = $web3_helper->getNonce(config('web3.wallet.address'));

        $txHash = null;

        $tokenInfo = TokenInfo::where('owner', config('web3.wallet.address'))
                    ->when($award->nft_type == 0, function($query) {
                        return $query->where('token_id', '<=', '125');
                    })->when($award->nft_type == 1, function($query) {
                        return $query->where('token_id', '>', '125');
                    })->first();

        if ($tokenInfo == null) {
            Log::info("No Nft to transfer");
            return ;
        }

        Log::info("Sending {$award->award_type} to {$award->address} - token id: {$award->token_id}");
        $txHash = $web3_helper->sendNftToUser($award->address, $tokenInfo->token_id, $nonce);

        $award->status = 1;
        $award->tx_hash = $txHash;
        $award->save();

        if ($txHash !== null) {
            Log::info("Waiting until last tx {$txHash} is confirmed");
            $transaction = $web3_helper->confirmTx($txHash);
            if (!$transaction) {
                throw new Error('Transaction was not confirmed.');
            } else {
                echo "Transaction confirmed\n";
            }
        } else {
            Log::info("No transactions are sent");
            echo ("No transactions are sent");
        }
        Log::info("SendAward ended");
    }
}

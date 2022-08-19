<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use \App\Lib\Web3Helper;
use \App\Models\TokenInfo;
use \App\Models\Config;

class UpdateTokenInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update NFT information';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        $web3_helper = new Web3Helper();

        $currentBlock = $web3_helper->getBlockNumber()->toHex();

        // remove leading zero
        if ($currentBlock[0] == '0') 
            $currentBlock = substr($currentBlock, 1);

        // append prefix
        $currentBlock = "0x" . $currentBlock;

        $lastSyncedBlock = "0x0";

        $synced = Config::firstOrCreate(['key' => 'Last Synced Block']);
        if ($synced->value != null) {
            $lastSyncedBlock = $synced->value;
        }

        Log::info("Syncing block # {$lastSyncedBlock} -> {$currentBlock}");

        $nft_address = config('web3.chain.nft');

        $body = "{
            \"id\":1,
            \"jsonrpc\":\"2.0\",
            \"method\":\"alchemy_getAssetTransfers\",
            \"params\":[
                {
                    \"fromBlock\":\"{$lastSyncedBlock}\",
                    \"toBlock\":\"{$currentBlock}\",
                    \"contractAddresses\":[\"{$nft_address}\"],
                    \"category\":[\"erc721\"],
                    \"withMetadata\":true,
                    \"maxCount\":\"0x3e8\"
                }
            ]
        }";

        $response = $client->request('POST', config('web3.chain.rpc'), [
            'body' => $body,
            'headers' => [
              'Accept' => 'application/json',
              'Content-Type' => 'application/json',
            ],
        ]);

        $result = json_decode($response->getBody())->result->transfers;

        foreach ($result as $trans) {
            $id = intval($trans->erc721TokenId, 16);
            $owner = $trans->to;
            $timestamp = date("Y-m-d h:i:s", strtotime($trans->metadata->blockTimestamp));
            
            $token = TokenInfo::firstOrCreate(
                ["token_id" => $id],
                ["owner" => $owner]
            );

            $token->owner = $owner;

            if ($token->purchase_time === null && $trans->from != "0x0000000000000000000000000000000000000000") {
                $token->purchase_time = $timestamp;
            }

            $token->save();
        }

        $synced->value = $currentBlock;
        $synced->save();
        
        return 0;
    }
}

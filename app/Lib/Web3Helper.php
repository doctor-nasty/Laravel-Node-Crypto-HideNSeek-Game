<?php

namespace App\Lib;

use Web3\Web3;
use Web3\Contract;
use Web3\Utils;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3p\EthereumTx\Transaction;
use Illuminate\Support\Facades\Log;

use phpseclib\Math\BigInteger;
use GuzzleHttp\Client;

use App\Models\TokenInfo;

class Web3Helper {
  function __construct() {
    $timeout = 30;
    $this->web3 = new Web3(new HttpProvider(new HttpRequestManager(config('web3.chain.rpc'), $timeout)));
  }

  public function sendTokenToUser($address, $amount, $nonce) {
    $web3 = $this->web3;

    $abi = json_decode(file_get_contents(base_path('public/web3/ERC20.json')));
    $token = new Contract($web3->provider, $abi);


    $amount = new BigInteger($amount * 100);
    $amount = $amount->multiply(new BigInteger(config('web3.chain.token_unit')))->divide(new BigInteger(100))[0]; // decimals

    // esitmate gas
    $estimatedGas = '0x200b20';

    $token->at(config('web3.chain.token'))->estimateGas('transfer', $address, $amount, [
      'from' => config('web3.wallet.address')
    ], function($err, $result) use(&$estimatedGas) {
      if ($err === null) {
        $estimatedGas = '0x' . $result->toHex();
      }
    });

    $data = $token->getData('transfer', $address, $amount);

    // get nonce
    $gasPrice = $this->getGasPrice();

    $chain_ids = [
      'Ethereum' => 1,
      'Rinkeby' => 4,
      'Polygon' => 137,
      'Mumbai' => 80001
    ];

    $transaction = new Transaction([
      'from' => config('web3.wallet.address'),
      'to' => config('web3.chain.token'),
      'nonce' => '0x' . $nonce->toHex(),
      'gas' => $estimatedGas,
      'gasPrice' => '0x' . $gasPrice->toHex(),
      'data' => '0x' . $data,
      'chainId' => $chain_ids[config("web3.chain.network")]
    ]);

    $transaction->sign(config('web3.wallet.private_key'));

    $txHash = null;
    $this->web3->getEth()->sendRawTransaction(
      '0x' . $transaction->serialize(), 
      function ($err, $transaction) use (&$txHash) {
        if ($err !== null) {
          Log::info("Error: " . $err->getMessage());
        } else {
          Log::info("Tx hash: {$transaction}");
          echo "Tx hash: {$transaction}\n";
          $txHash = $transaction;
        }
      });
    
    return $txHash;
  }

  public function getPirateDelegator($address) {
    $numOwned = TokenInfo::where([
      ['token_id', '<=', 125],
      ['owner', $address],
      ['status', '<>', 2]
    ])->count();

    if ($numOwned > 0) return null;

    return TokenInfo::where([
      ['token_id', '<=', 125],
      ['borrower', $address],
      ['status', 2]
    ])->first();
  }

  public function canCreateGame($address) {
    $num = TokenInfo::where('token_id', '<=', 125)
                    ->where(function($query) use($address) {
                      $query->where([
                        ['owner', $address],
                        ['status', '<>', 2]
                      ])->orWhere([
                        ['borrower', $address],
                        ['status', 2]
                      ]);
                    })->count();

    return $num > 0;
    // $nfts = $this->getNFTs($address);

    // for ($i = 0; $i < count($nfts); $i++) {
    //   if ($nfts[$i] <= 125) return true;
    // }

    // return false;
  }

  public function getTreasureDelegator($address) {
    $numOwned = TokenInfo::where([
      ['token_id', '>', 125],
      ['owner', $address],
      ['status', '<>', 2]
    ])->count();

    if ($numOwned > 0) return null;

    return TokenInfo::where([
      ['token_id', '>', 125],
      ['borrower', $address],
      ['status', 2]
    ])->first();
  }

  public function canPlayGame($address) {
    $num = TokenInfo::where('token_id', '>', 125)
                    ->where(function($query) use($address) {
                      $query->where([
                        ['owner', $address],
                        ['status', '<>', 2]
                      ])->orWhere([
                        ['borrower', $address],
                        ['status', 2]
                      ]);
                    })->count();

    return $num > 0;
    // $nfts = $this->getNFTs($address);

    // for ($i = 0; $i < count($nfts); $i++) {
    //   if ($nfts[$i] > 125) return true;
    // }

    // return false;
  }

  public function getNFTs($address) {
    $tokenIds = [];

    $tokens = TokenInfo::where('owner', $address)->paginate(10);

    foreach($tokens as $token) {
      array_push($tokenIds, $token->token_id);
    }

    return $tokenIds;

    // $client = new Client();
    // $page_key = '';
    // $total_cnt = 0;

    // $rep = 0;

    // while (true) {
    //   $url = config('web3.chain.rpc') . '/getNFTs';
    //   $url .= '?owner='. $address;
    //   $url .= '&contractAddresses[]=' . config('web3.chain.nft');
    //   $url .= '&withMetadata=false';

    //   if ($page_key !== '') {
    //     $url .= '&pageKey=' . $page_key;
    //   }

    //   $response = $client->request('GET', $url, [
    //     'headers' => [
    //       'Accept' => 'application/json',
    //     ],
    //   ]);

    //   $result = json_decode($response->getBody());

    //   $total_cnt = $result->totalCount;

    //   $cnt = count($result->ownedNfts);
    //   for ($i = 0; $i < $cnt; $i++) {
    //     array_push($tokenIds, hexdec($result->ownedNfts[$i]->id->tokenId));
    //   }

    //   if (isset($result->pageKey)) {
    //     // pages
    //     $page_key =  $result->pageKey;
    //   } else {
    //     break;
    //   }
    // }
    
    // return $tokenIds;
  }

  public function getBlockNumber() {
    $timeout = 30;
    $web3 = new Web3(new HttpProvider(new HttpRequestManager(config('web3.chain.rpc'), $timeout)));
    $web3->getEth()->blockNumber(function ($err, $result) use(&$blockNumber) {
      $blockNumber = $result;
    });

    return $blockNumber;
  }

  public function getBalance($account) {
    $eth = $this->web3->getEth();

    $balance = 0;
    $eth->getBalance($account, function ($err, $rawBalance) use (&$balance) {
      if ($err !== null) {
        throw $err;
      }
      $balance = $rawBalance;
    });
    return $balance;
  }

  public function getGasPrice() {
    $eth = $this->web3->getEth();

    $gasPrice = 0;
    $eth->gasPrice(function ($err, $rawGasPrice) use (&$gasPrice) {
      if ($err !== null) {
        throw $err;
      }
      $gasPrice = $rawGasPrice;
    });
    return $gasPrice;
  }

  public function getNonce($account) {
    $eth = $this->web3->getEth();

    $nonce = 0;
    $eth->getTransactionCount($account, function ($err, $count) use (&$nonce) {
      if ($err !== null) {
        throw $err;
      }
      $nonce = $count;
    });
    return $nonce;
  }

  public function getTransactionReceipt($txHash) {
    $eth = $this->web3->getEth();

    $tx;
    $eth->getTransactionReceipt($txHash, function ($err, $transaction) use (&$tx) {
      if ($err !== null) {
        throw $err;
      }
      $tx = $transaction;
    });
    return $tx;
  }

  public function confirmTx($txHash) {
    $eth = $this->web3->getEth();

    $transaction = null;
    while (!$transaction) {
      $transaction = $this->getTransactionReceipt($txHash);
      
      if ($transaction) {
        return $transaction;
      } else {
        echo "Sleep one second and wait transaction to be confirmed\n";
        sleep(1);
      }
    }
  }
}
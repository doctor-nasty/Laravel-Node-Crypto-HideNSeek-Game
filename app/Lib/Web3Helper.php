<?php

namespace App\Lib;

use Web3\Web3;
use Web3\Contract;
use Web3\Utils;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3p\EthereumTx\Transaction;

use phpseclib\Math\BigInteger;
use GuzzleHttp\Client;

use App\Models\TokenInfo;

class Web3Helper {
  public function sendTokenToUser($address, $amount) {
    $timeout = 30;
    $web3 = new Web3(new HttpProvider(new HttpRequestManager(config('web3.chain.rpc'), $timeout)));

    $eth = $web3->getEth();

    $abi = json_decode(file_get_contents(base_path('public/web3/ERC20.json')));
    $token = new Contract($web3->provider, $abi);


    $amount = new BigInteger($amount);
    $amount = $amount->multiply(new BigInteger(config('web3.chain.token_unit'))); // decimals

    // esitmate gas
    $estimatedGas = '0x200b20';

    $token->at(config('web3.chain.token'))->estimateGas('transfer', $address, $amount->toString(), [
      'from' => config('web3.wallet.address')
    ], function($err, $result) use(&$estimatedGas) {
      if ($err === null) {
        $estimatedGas = '0x' . $result->toHex();
      }
    });

    $data = $token->getData('transfer', $address, $amount);

    // get nonce
    $nonce = $this->getNonce($eth, config('web3.wallet.address'));
    $gasPrice = $this->getGasPrice($eth);

    $transaction = new Transaction([
      'from' => config('web3.wallet.address'),
      'to' => config('web3.chain.token'),
      'nonce' => '0x' . $nonce->toHex(),
      'gas' => $estimatedGas,
      'gasPrice' => '0x' . $gasPrice->toHex(),
      'data' => '0x' . $data,
      'chainId' => 80001
    ]);

    $transaction->sign(config('web3.wallet.private_key'));

    $eth->sendRawTransaction(
      '0x' . $transaction->serialize(), 
      function ($err, $transaction) use (&$txHash) {
        if ($err !== null) {
          echo 'Error: ' . $err->getMessage();
        } else {
          echo 'Tx hash: ' . $transaction . "<br>\n";
          $txHash = $transaction;
        }
      });

    if ($txHash !== null) {
      $transaction = $this->confirmTx($eth, $txHash);
      if (!$transaction) {
        throw new Error('Transaction was not confirmed.');
      } else {
        echo 'Transaction confirmed' . "<br>\n";
      }
    }
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

  public function getDelegator($address) {
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

  function getBalance($eth, $account) {
    $balance = 0;
    $eth->getBalance($account, function ($err, $rawBalance) use (&$balance) {
      if ($err !== null) {
        throw $err;
      }
      $balance = $rawBalance;
    });
    return $balance;
  }

  function getGasPrice($eth) {
    $gasPrice = 0;
    $eth->gasPrice(function ($err, $rawGasPrice) use (&$gasPrice) {
      if ($err !== null) {
        throw $err;
      }
      $gasPrice = $rawGasPrice;
    });
    return $gasPrice;
  }

  function getNonce($eth, $account) {
    $nonce = 0;
    $eth->getTransactionCount($account, function ($err, $count) use (&$nonce) {
      if ($err !== null) {
        throw $err;
      }
      $nonce = $count;
    });
    return $nonce;
  }

  function getTransactionReceipt($eth, $txHash) {
    $tx;
    $eth->getTransactionReceipt($txHash, function ($err, $transaction) use (&$tx) {
      if ($err !== null) {
        throw $err;
      }
      $tx = $transaction;
    });
    return $tx;
  }

  function confirmTx($eth, $txHash) {
    $transaction = null;
    while (!$transaction) {
      $transaction = $this->getTransactionReceipt($eth, $txHash);
      if ($transaction) {
        return $transaction;
      } else {
        echo "Sleep one second and wait transaction to be confirmed" . "<br>\n";
        sleep(1);
      }
    }
  }
}
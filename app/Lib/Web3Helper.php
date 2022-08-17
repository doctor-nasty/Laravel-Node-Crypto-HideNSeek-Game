<?php

namespace App\Lib;

use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use phpseclib\Math\BigInteger;
use GuzzleHttp\Client;

class Web3Helper {
  public function canCreateGame($address) {
    $nfts = $this->getNFTs($address);

    for ($i = 0; $i < count($nfts); $i++) {
      if ($nfts[$i] <= 125) return true;
    }

    return false;
  }

  public function canPlayGame($address) {
    $nfts = $this->getNFTs($address);

    for ($i = 0; $i < count($nfts); $i++) {
      if ($nfts[$i] > 125) return true;
    }

    return false;
  }

  public function getNFTs($address) {
    $tokenIds = [];

    $client = new Client();
    $page_key = '';
    $total_cnt = 0;

    $rep = 0;

    while (true) {
      $url = config('web3.chain.rpc') . '/getNFTs';
      $url .= '?owner='. $address;
      $url .= '&contractAddresses[]=' . config('web3.chain.nft');
      $url .= '&withMetadata=false';

      if ($page_key !== '') {
        $url .= '&pageKey=' . $page_key;
      }

      $response = $client->request('GET', $url, [
        'headers' => [
          'Accept' => 'application/json',
        ],
      ]);

      $result = json_decode($response->getBody());

      $total_cnt = $result->totalCount;

      $cnt = count($result->ownedNfts);
      for ($i = 0; $i < $cnt; $i++) {
        array_push($tokenIds, hexdec($result->ownedNfts[$i]->id->tokenId));
      }

      if (isset($result->pageKey)) {
        // pages
        $page_key =  $result->pageKey;
      } else {
        break;
      }
    }
    
    return $tokenIds;
  }
}
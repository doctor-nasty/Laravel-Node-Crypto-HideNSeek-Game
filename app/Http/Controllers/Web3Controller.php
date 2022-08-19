<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use phpseclib\Math\BigInteger;
use GuzzleHttp\Client;

class Web3Controller
{
    public function test() {
        $web3_helper = new \App\Lib\Web3Helper();

        $web3_helper->sendTokenToUser(config('web3.wallet.address'), 1);
    }

    public function signature()
    {
        $nonce = Str::random();
        request()->session()->put('nonce', $nonce);

        return $this->generateSignatureMessage($nonce);
    }

    public function login()
    {
        $data = request()->validate([
            'address' => ['required', 'string', 'regex:/0x[a-fA-F0-9]{40}/m'],
            'signature' => ['required', 'string', 'regex:/^0x([A-Fa-f0-9]{130})$/'],
        ]);

        // verify signature
        if ($this->verifySignature(request()->session()->pull('nonce'), $data['signature'], $data['address'])) {
            return "Invalid signature";
        }

        // verify token balance
        $timeout = 30; // set this time accordingly by default it is 1 sec
        $web3 = new Web3(new HttpProvider(new HttpRequestManager(config('web3.chain.rpc'), $timeout)));
        $abi = json_decode(file_get_contents(base_path('public/web3/HidenSeekToken.json')));
        $nft = new Contract($web3->provider, $abi);
        $balance = new BigInteger(0);
        $error = "";

        // check balance
        $nft->at(config('web3.chain.nft'))->call('balanceOf', $data['address'], function($err, $result) use(&$balance, &$error) {
            if ($err !== null) {
                // error occured
                $error = "Error: " . $err->getMessage();
            } else {
                $balance = $result[0];
            }
        });

        if ($error !== "") return $error;

        if ($balance->compare(new BigInteger(0)) <= 0) {
            return 'Error: Insufficient balance';
        }
        
        $user = $this->getUserModel()::firstOrCreate([
            config('web3.model.column') => $data['address'],
        ]);

        if (! is_null(request()->user()) && request()->user()->id !== $user->id) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        Auth::login($user);

        return 'Success';
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return response()->noContent();
    }

    public function getBalance() {
        $address = Auth::user()->wallet_address;

        $timeout = 30;
        $web3 = new Web3(new HttpProvider(new HttpRequestManager(config('web3.chain.rpc'), $timeout)));
        $abi = json_decode(file_get_contents(base_path('public/web3/ERC20.json')));
        $token = new Contract($web3->provider, $abi);

        $balance = "0";
        $error = "";

        // check balance
        $token->at(config('web3.chain.token'))->call('balanceOf', $address, function($err, $result) use(&$balance, &$error) {
            if ($err !== null) {
                // error occured
                $error = "Error: " . $err->getMessage();
            } else {
                $balance = $result['balance']->toString();
            }
        });

        if ($error !== "") return $error;

        return number_format(floatval($balance) / floatval(config('web3.chain.token_unit')), 2);
    }

    public function canCreateGame() {
        $web3_helper = new \App\Lib\Web3Helper();

        if ($web3_helper->canCreateGame(Auth::user()->wallet_address)) {
            return "Yes";
        } else {
            return "No";
        }
    }

    public function canPlayGame() {
        $web3_helper = new \App\Lib\Web3Helper();

        if ($web3_helper->canPlayGame(Auth::user()->wallet_address)) {
            return "Yes";
        } else {
            return "No";
        }
    }

    public function getNFTs() {
        $web3_helper = new \App\Lib\Web3Helper();
        return $web3_helper->getNFTs(Auth::user()->wallet_address);
    }

    protected function getUserModel(): Model
    {
        return app(config('auth.providers.users.model'));
    }

    protected function generateSignatureMessage($nonce)
    {
        $appName = config('app.name');

        return "Welcome to {$appName}. Sign this message to login.\n\nNonce: $nonce";
    }

    protected function verifySignature($nonce, $signature, $address)
    {
        $message = $this->generateSignatureMessage($nonce);
        $msglen = strlen($message);
        $hash = \kornrunner\Keccak::hash("\x19Ethereum Signed Message:\n{$msglen}{$message}", 256);
        $sign = ["r" => substr($signature, 2, 64), "s" => substr($signature, 66, 64)];
        $recid = ord(hex2bin(substr($signature, 130, 2))) - 27;
        if ($recid != ($recid & 1)) {
            return false;
        }
        $pubkey = (new \Elliptic\EC('secp256k1'))->recoverPubKey($hash, $sign, $recid);

        return hash_equals($address, $this->pubKeyToAddress($pubkey));
    }

    protected function pubKeyToAddress($pubkey)
    {
        return "0x" . substr(\kornrunner\Keccak::hash(substr(hex2bin($pubkey->encode("hex")), 1), 256), 24);
    }
}
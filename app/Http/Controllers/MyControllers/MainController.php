<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Game;
use App\Game_bid;
use App\User;
use Notification;
use App\Notifications\GameBiddedNotification;


class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMain()
    {

        $web3_helper = new \App\Lib\Web3Helper();
        
        $tokens = $web3_helper->getNFTs(Auth::user()->wallet_address);

        $nft_name = [];
        $nft_image = [];
        foreach ($tokens as $index => $token_id) {
            $url = 'https://bafybeidunbtz7jt2xnhxbm6xfifzzpjokjlf55ztx54u6vgpln6swztwfa.ipfs.nftstorage.link/metadata/'.$token_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result= curl_exec ($ch);
            curl_close ($ch);
            $j=json_decode($result, true);
            $nft_name[$index] = $j['name'];
            $nft_image[$index] = $j['image'];
            };


        

        $games = Game_bid::where('user_id', Auth::user()->id)->get()->count();
        $user = Auth::user();
        return view('pages.dashboard', ['games_played' => $games], compact('nft_name', 'nft_image', 'tokens'));
    }

}

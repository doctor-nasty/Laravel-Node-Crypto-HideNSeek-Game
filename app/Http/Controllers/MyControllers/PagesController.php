<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Game_bid;
use App\Models\TokenInfo;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function documentation()
    {
        return view('pages.documentation')
        ->with('title', 'Documentation');
    }

    public function delegations()
    {
        $user_wallet = strtolower(Auth::user()->wallet_address);
        $tokens = TokenInfo::where('owner', $user_wallet)
                            ->orWhere([
                                ['borrower', $user_wallet],
                                ['status', 2],
                                //['expiresAt', '>', now()]
                            ])->get();
        foreach($tokens as $index => $token) {
            // get token metadata
            $url = 'https://bafybeidunbtz7jt2xnhxbm6xfifzzpjokjlf55ztx54u6vgpln6swztwfa.ipfs.nftstorage.link/metadata/'.$token->token_id;
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

            $token->name = $j['name'];
            $token->image = $j['image'];
        }

        return view('pages.delegations')
        ->with('title', 'Delegations')
        ->with('tokens', $tokens)
        ->with('my_address', $user_wallet);
    }

    public function borrow()
    {
        $delegations = TokenInfo::where('status', 1);

        return view('auth.login')
        ->with('delegations', $delegations);
    }

    public function contact()
    {
        return view('pages.contact')
        ->with('title', Lang::trans('title.contact'));
    }

    public function myitems()
    {
        $web3_helper = new \App\Lib\Web3Helper();
        
        $tokens = TokenInfo::where('owner', Auth::user()->wallet_address)
                            ->orWhere([
                                ['borrower', Auth::user()->wallet_address],
                                ['status', 2],
                                //['expiresAt', '>', now()]
                            ])->get();

        $nft_name = [];
        $nft_image = [];
        foreach ($tokens as $index => $token) {
            $url = 'https://bafybeidunbtz7jt2xnhxbm6xfifzzpjokjlf55ztx54u6vgpln6swztwfa.ipfs.nftstorage.link/metadata/'.$token->token_id;
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

        return view('pages.myitems', compact('nft_name', 'nft_image', 'tokens'))
        ->with('title', 'My Items');
    }

    public function requests()
    {
        return view('pages.requests')
        ->with('title', Lang::trans('title.requests'));
    }

    public function mybids()
    {

        $gamesbidded = Game_bid::select(
    'games.id', 'games.status', 'games.title', 'games.country', 'games.city', 'games.district', 'games.type', 'games.comment', 'games.points', 'games.created_at', 'games.photo')
    ->where('games.status', '=', '1')
    ->where('game_bids.user_id', '=', Auth::user()->id)
    ->leftJoin('games', 'game_bids.game_id', '=', 'games.id')
    ->leftJoin('users', 'game_bids.user_id', '=', 'users.id')->get();

        return view('my_bids.my_bids', compact('gamesbidded'))
        ->with('title', 'My Bids');
    }
}

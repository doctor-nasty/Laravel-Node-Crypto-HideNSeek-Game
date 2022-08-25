<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Game_bid;
use App\Game;
use App\Models\Award;
use Auth;
use Illuminate\Support\Facades\Lang;
use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GameBiddedNotification;

use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use phpseclib\Math\BigInteger;

class PointsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        // $users = User::where('status', 1)->orderBy('points', 'desc')->paginate(10);
        return view('points.points')
        ->with('title', Lang::trans('title.points'));
    }

    public function buyPoints() {
        return view('points.buy')
        ->with('title', Lang::trans('title.buy_points'));
    }

    public function buyPoint(Request $request) {


        if (!$request->user()->hasStripeId()) {

            $request->user()->createAsStripeCustomer();
            $request->user()->updateCard($request->stripeToken);
        }

        $request->user()->charge(($request->points / 2) * 100);

        $user = User::where('id', Auth::user()->id)
                        ->get()->toArray();

        User::where('id', Auth::user()->id)
                ->update(['points' => $user[0]['points'] + $request->points]);

        //$request->user()->charge(50);
        return redirect('buypoints')->with('success', 'Your points creadited to your account successfully');
    }

    protected function checkConfirmation($txHash, $points) {
        // get transaction data
        $timeout = 30; // set this time accordingly by default it is 1 sec
        $web3 = new Web3(new HttpProvider(new HttpRequestManager(config('web3.chain.rpc'), $timeout)));

        $sender = '';
        $token_addr = '';
        $tx_data = '';
        $block_number = '';
        $nonce = 0;

        $web3->getEth()->getTransactionByHash($txHash, 
            function($err, $result) use(&$sender, &$token_addr, &$tx_data, &$block_number, &$nonce) {
                if ($err === null) {
                    // print_r($result);
                    $sender = $result->from;
                    $token_addr = $result->to;
                    $tx_data = $result->input;
                    $block_number = $result->blockNumber;
                    $nonce = hexdec(substr($result->nonce, 2));
                }
            }
        );

        if ($sender === '') {
            // getting transaction data failed
            return false;
        }

        // check validity
        if (strcasecmp($sender, Auth::user()->wallet_address) != 0) {
            // sender is invalid
            return false;
        }

        if (strcasecmp($token_addr, config('web3.chain.token')) != 0) {
            // token address is invalid
            return false;
        }

        $abi = json_decode(file_get_contents(base_path('public/web3/ERC20.json')));
        $token = new Contract($web3->provider, $abi);

        $points = new BigInteger($points);

        $points = $points->multiply(new BigInteger(config('web3.chain.token_unit'))); // decimals

        $data = $token->at($token_addr)->getData('transfer', config('web3.wallet.address'), $points->toString());

        if ($tx_data !== '0x' . $data) {
            // tx data is invalid
            return false;
        }

        if ($nonce <= Auth::user()->payment_nonce) {
            // duplicated nonce
            return false;
        }

        // save last nonce to prevent double payment
        $user = User::where('id', Auth::user()->id)->get()->first();
        $user->payment_nonce = $nonce;
        $user->save();

        return true;
    }

    public function bid($game_id, Request $request) {
        // check validataion of tx hash
        $request->validate([
            'points' => 'required',
            'tx_hash' => ['required', 'string', 'regex:/^0x([A-Fa-f0-9]{64})$/']
        ]);

        if (!$this->checkConfirmation($request['tx_hash'], $request['points'])) {
            return redirect()->back()->with('error', 'Transaction confirmation failed');
        }

        // check point
        $game = Game::find($game_id);

        if ($game->points != $request['points']) {
            return redirect()->back()->with('error', 'Game points mismatch');
        }

        // actual bid
        $bid = new Game_bid;
        $bid->game_id = $game_id;
        $bid->user_id = Auth::user()->id;
        $bid->is_awarded = 0;

        $bid->save();

        // if ($bid->save()) {
        //     $game = Game::find($game_id);
        //     $user = User::find(Auth::user()->id);
        //     $user->points = $user->points - $game->points;
        //     $user->save();
        // }

        // $user = \App\Game_bid::find(1);
        // $user = (\DB::select("SELECT user_id FROM game_bids WHERE game_id = Game::find($game_id)"))->first();
        $bids = Game_bid::where('game_id', $bid->game_id)
        ->get()
        ->toArray();

        if (count($bids) < 3) {

        $users = User::whereHas('game_bids', function ($query) use ($game_id, $bid) {
            $query->where('game_id', $game_id)->where('user_id', '!=', $bid->user_id);
        })->get();

        $details = [
            'title' => $game->title,
            'data' => 'Player has joined',
            'thanks' => 'Thanks!',
        ];

        foreach ($users as $user) {
            $user->notify(new \App\Notifications\GameBiddedNotification($details));
        }

        }


//        return redirect('games/' . $game_id)->with('success', 'Your bid placed successfully');
        return redirect('my_bids')->with('success', 'Your bid placed successfully');
    }

    public function bidAnswer(Request $request) {

        $game = Game::where('id', $request->game_id)->get()->first();
        $user = User::where('id', Auth::user()->id)->get()->first();
        $bid = Game_bid::where(['user_id' => Auth::user()->id, 'game_id' => $request->game_id])
                ->get()
                ->first();
        
        if ($bid->num_failure >= 5) {
            return redirect('/my_bids')->with('error', 'Sorry, you failed 5 times already. Cannot play anymore!');
        }

        $bids = Game_bid::where('game_id', $request->game_id)
                ->get()
                ->toArray();
        
        if (!empty($game)) {
            if ($request->osm_id == $game->osm_id && $request->place_id == $game->place_id) {
                $gameAuthor = User::where('id', $game->user_id)->get()->first();

                $game->status = 2;
                $game->winner_user_id = Auth::user()->id;
                $game->save();

                $bid->is_awarded = 1;
                $bid->save();

                $total_points = (count($bids) + 1) * $game->points;

                $web3_helper = new \App\Lib\Web3Helper();
                
                $winning_points = $total_points * 55 / 100.0; // winner 55%
                $delegator = $web3_helper->getTreasureDelegator($user->wallet_address);

                if ($delegator !== null) {
                    $delegator_points = $total_points * 15 / 100.0; // 15% for owner
                    $winning_points -= $delegator_points; // remaining - 40% for borrower
                    Award::create([
                        'address' => $delegator->owner,
                        'amount' => $delegator_points,
                        'award_type' => 'Game winner award(delegator)'
                    ]);
                }

                Award::create([
                    'address' => $user->wallet_address,
                    'amount' => $winning_points,
                    'award_type' => 'Game winner award'
                ]);

                $user->total_winning_points += $winning_points;
                $user->save();

                $creator_points = $total_points * 30 / 100.0; // creator 30%

                $delegator = $web3_helper->getPirateDelegator($gameAuthor->wallet_address);
                if ($delegator !== null) {
                    $delegator_points = $total_points * 20 / 100.0; // 20% for owner
                    $creator_points -= $delegator_points; // remaining part - 10% for borrower
                    Award::create([
                        'address' => $delegator->owner,
                        'amount' => $delegator_points,
                        'award_type' => 'Game creator award(delegator)'
                    ]);
                }
                // send to createor
                Award::create([
                    'address' => $gameAuthor->wallet_address,
                    'amount' => $creator_points,
                    'award_type' => 'Game creator award'
                ]);

                return redirect('games')->with('success', 'You have won the game!');
            } else {
                $bid->num_failure += 1;
                $bid->save();
//                return redirect('games/' . $request->game_id)->with('error', 'Sorry, Your answer code is incorrect!');
                return redirect('my_bids')->with('error', 'Sorry, Your answer code is incorrect! ' . $bid->num_failure);
            }
        } else {
            return redirect('games')->with('error', 'Game not found!');
        }
    }

    public function buyPointsPaypal(Request $request) {

        $user = User::where('id', Auth::user()->id)
                        ->get()->toArray();

        $result = DB::table('paypal_points_charge')->insert([
            'user_id' => Auth::user()->id,
            'charge_id' => $request->data['id'],
            'payload' => json_encode($request->data),
        ]);

        User::where('id', Auth::user()->id)
                ->update(['points' => $user[0]['points'] + $request->points]);

        return response()->json([
            'status' => $result,
            'message' => 'Your points creadited to your account successfully.'
        ]);
    }

}

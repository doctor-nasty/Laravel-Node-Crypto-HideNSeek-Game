<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Game_bid;
use App\Game;
use Auth;
use Illuminate\Support\Facades\Lang;
use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GameBiddedNotification;


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

    public function bid($game_id) {
        $bid = new Game_bid;
        $bid->game_id = $game_id;
        $bid->user_id = Auth::user()->id;
        $bid->is_awarded = 0;

        if ($bid->save()) {
            $game = Game::find($game_id);
            $user = User::find(Auth::user()->id);
            $user->points = $user->points - $game->points;
            $user->save();
        }

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
            'data' => 'მოთამაშე შემოვიდა',
            'thanks' => 'მადლობა!',
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

        $bids = Game_bid::where('game_id', $request->game_id)
                ->get()
                ->toArray();

        if (!empty($game)) {
            if ($request->answer == $game->identifier) {
                $gameAuthor = User::where('id', $game->user_id)->get()->first();

                $game->status = 2;
                $game->winner_user_id = Auth::user()->id;
                $game->save();

                $bid->is_awarded = 1;
                $bid->save();

                // $winning_points = ((count($bids) * $game->points + $game->points) * 50) / 100;
                $winning_points = (((count($bids) + 1) * $game->points + $game->points) * 60) / 100;
                $user->points += $winning_points;
                $user->total_winning_points += $winning_points;
                $user->save();

                // $gameAuthor->points += ((count($bids) * $game->points + $game->points) * 50) / 100;
                $gameAuthor->points += (((count($bids) + 1) * $game->points + $game->points) * 30) / 100;
                $gameAuthor->save();

                return redirect('games')->with('success', 'You have won the game!');
            } else {
//                return redirect('games/' . $request->game_id)->with('error', 'Sorry, Your answer code is incorrect!');
                return redirect('my_bids')->with('error', 'Sorry, Your answer code is incorrect!');
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

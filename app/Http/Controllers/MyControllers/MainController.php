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
use App\Models\TokenInfo;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMain()
    {
        
        $owngames = Game::where('user_id', '=', Auth::user()->id)->get();


        $gamesbidded = Game_bid::select(
            'games.id', 'games.status', 'games.title', 'games.country', 'games.city', 'games.district', 'games.type', 'games.comment', 'games.points', 'games.created_at', 'games.photo')
            ->where('games.status', '=', '1')
            ->where('game_bids.user_id', '=', Auth::user()->id)
            ->leftJoin('games', 'game_bids.game_id', '=', 'games.id')
            ->leftJoin('users', 'game_bids.user_id', '=', 'users.id')->get();
        


        $gamesplayed = Game_bid::where('user_id', Auth::user()->id)->get()->count();
        $user = Auth::user();
        $points_earned = $user->total_winning_points;
        return view('pages.dashboard', compact('gamesplayed', 'gamesbidded', 'owngames', 'points_earned'));
    }

}

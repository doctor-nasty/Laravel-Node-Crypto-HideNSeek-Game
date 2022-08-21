<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Game_bid;

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
        return view('pages.delegations')
        ->with('title', 'Delegations');
    }

    public function contact()
    {
        return view('pages.contact')
        ->with('title', Lang::trans('title.contact'));
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

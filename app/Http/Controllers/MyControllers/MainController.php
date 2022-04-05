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
        $games = Game_bid::where('user_id', Auth::user()->id)->get()->count();
        $user = Auth::user();
        return view('pages.dashboard', ['games_played' => $games]);
    }

    // public function sendNotification()
    // {
    //     $user = User::first();

    //     $details = [
    //         'greeting' => 'Hi Artisan',
    //         'body' => 'This is my first notification from ItSolutionStuff.com',
    //         'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
    //         'actionText' => 'View My Site',
    //         'actionURL' => url('/'),
    //         'order_id' => 101
    //     ];

    //     Notification::send($user, new GameBiddedNotification($details));

    //     dd('done');
    // }

}

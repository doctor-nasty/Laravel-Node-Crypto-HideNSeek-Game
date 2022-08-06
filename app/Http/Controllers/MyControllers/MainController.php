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
        // $url = 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=45.533&lon=35.423';
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,$url);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); 
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // $result= curl_exec ($ch);
        // curl_close ($ch);
        // $info = json_decode($result, true); 
        

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

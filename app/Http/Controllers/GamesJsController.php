<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GamesJsController extends Controller
{
    // public function ListGames(Request $request)
    // {
    //     $query = Game::select(
    //         'games.id',
    //         'games.status',
    //         'games.title',
    //         'games.city',
    //         'games.district',
    //         'games.type',
    //         'games.comment',
    //         'games.points',
    //         'games.created_at',
    //         'games.photo');
    //         // ->leftJoin('game_bids', 'games.status', '=', 'game_bids.is_awarded');
    //         // ->where('games.user_id', '=', Auth::user()->id);
    //         // ->whereIn('games.status_id', [ExamManager::getStatus(false, 'regular')->id, ExamManager::getStatus(false, 'retake')->id]);
    //     // if($request->has('status')){ $query->where('games.status', '=', $request->input('status')); }
    //     return DataTables::of($query)->toJson();
    // }
}

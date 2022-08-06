<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Game;
use App\User;
use App\Game_bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class JsController extends Controller {

    public function ListGames(Request $request) {

//        Cache::remember('articles', 1500, function() {
//            return '----250000----';
//        });
//
        //echo "<pre>";
        //print_r($request->length);
        //print_r(Cache::has('articles'));
        //print_r(Cache::has('new_game_'.Auth::user()->id));
        //print_r(Cache::get('articles'));
        //print_r(Cache::get('games'));
        //die;
        if (false && Cache::has('new_game_'.Auth::user()->id)) {
//            echo "<pre>";
//            print_r('123123inin');
//            print_r(Cache::get('new_game_'.Auth::user()->id));
//            die;
            $data = Cache::get('new_game_'.Auth::user()->id);
//            $temp = $data->getData();
//            $temp->draw += 1;
//            $data->setData($temp);
//            Cache::forget('new_game_'.Auth::user()->id);
//            Cache::remember('new_game_'.Auth::user()->id, 3600, function() use($data) {
//                return $data;
//            });

//            echo "<pre>";
//            print_r($data->setData($temp));
//            print_r($data->getData());
//            die;
            return $data;
        } else {
        //    echo "<pre>";
        //    print_r('123123');
        //    die;
            $query = DB::table('games')
            ->leftJoin('users', 'games.user_id', '=', 'users.id')
            ->select('users.average_rating', 'games.id', 'games.status', 'games.title', 'games.city', 'games.district', 'games.type', 'games.comment', 'games.points', 'games.created_at', 'games.photo')
                    ->where('games.user_id', '<>', Auth::user()->id)
                    ->where('games.status', '=', '1')
                    // ->random(10);
                    ->orderByRaw('RAND()')
                    ->take(10);
            // ->whereIn('games.status_id', [ExamManager::getStatus(false, 'regular')->id, ExamManager::getStatus(false, 'retake')->id]);

            // $data = DataTables::of($query->orderByRaw('RAND()'))->toJson();
            $data = DataTables::of($query)->toJson();

            $result = Cache::remember('new_game_'.Auth::user()->id, 600, function() use($data) {
                return $data;
            });

            return $result;
        }

//        return DataTables::of($query->orderByRaw('RAND()')->remember(5))->toJson();
//        return DataTables::of($query->take($request->length)->orderByRaw('RAND()')->remember(10))->toJson();
//        return DataTables::of($query->orderByRaw('RAND()'))->toJson();
    }

    public function ListOwnGames(Request $request) {
        $query = Game::select(
                        'games.id', 'games.status', 'games.title', 'games.city', 'games.district', 'games.type', 'games.comment', 'games.points', 'games.created_at', 'games.photo')
                ->where('games.user_id', '=', Auth::user()->id);
        // ->leftJoin('game_bids', 'games.status', '=', 'game_bids.is_awarded');
        // ->whereIn('games.status_id', [ExamManager::getStatus(false, 'regular')->id, ExamManager::getStatus(false, 'retake')->id]);
        // if($request->has('status')){ $query->where('games.status', '=', $request->input('status')); }
        return DataTables::of($query)->toJson();
    }

    public function ListUsers(Request $request) {
        $query = User::select(
            'users.id', 'users.username', 'users.status', 'users.avatar', 'users.created_at', 'users.points', 'users.average_rating');
                // ->where('games.user_id', '=', Auth::user()->id);
        return DataTables::of($query)->toJson();
    }

    public function ListBidGames(Request $request) {
//        echo "<pre>";
//        print_r(Auth::user()->id);
//        print_r(Game_bid::all()->toArray());
//        die;
        $query = Game_bid::select(
                        'games.id', 'games.status', 'games.title', 'games.city', 'games.district', 'games.type', 'games.comment', 'games.points', 'games.created_at', 'games.photo')
                // ->where(['games.user_id' => Game_bid::find($user_id)]);
                ->where('games.status', '=', '1')
                ->where('game_bids.user_id', '=', Auth::user()->id)
                ->leftJoin('games', 'game_bids.game_id', '=', 'games.id')
                ->leftJoin('users', 'game_bids.user_id', '=', 'users.id');
        // ->whereIn('games.status_id', [ExamManager::getStatus(false, 'regular')->id, ExamManager::getStatus(false, 'retake')->id]);
        // if($request->has('status')){ $query->where('games.status', '=', $request->input('status')); }
//        return DataTables::of($query)->toJson();
        $data = DataTables::of($query);
        return $data->toJson();
    }

    public function ListMyBids(Request $request) {
        return 1;
        $query = Game::select(
                        'games.id', 'games.status', 'games.title', 'games.city', 'games.district', 'games.type', 'games.comment', 'games.points', 'games.created_at', 'games.photo')
                // ->where(['games.user_id' => Game_bid::find($user_id)]);
                ->where('games.status', '=', '1')
                ->leftJoin('game_bids', 'games.user_id', '=', 'game_bids.user_id');
        // ->whereIn('games.status_id', [ExamManager::getStatus(false, 'regular')->id, ExamManager::getStatus(false, 'retake')->id]);
        // if($request->has('status')){ $query->where('games.status', '=', $request->input('status')); }
//        $data = DataTables::of($query);
//        return $data->toJson();
        return DataTables::of($query)->toJson();
    }

    public function ListPoints(Request $request) {
        $query = User::select(
                        'users.id', 'users.username', 'users.status', 'users.avatar', 'users.created_at', 'users.points');
        // ->leftJoin('game_bids', 'games.status', '=', 'game_bids.is_awarded');
        // ->where('games.user_id', '=', Auth::user()->id);
        // ->whereIn('games.status_id', [ExamManager::getStatus(false, 'regular')->id, ExamManager::getStatus(false, 'retake')->id]);
        // if($request->has('status')){ $query->where('games.status', '=', $request->input('status')); }
        return DataTables::of($query)->toJson();
    }

}

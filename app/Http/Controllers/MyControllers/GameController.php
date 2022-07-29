<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;

class GameController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        // $this->middleware('ajax', ['except' => ['index', 'create']]);
    }

    public function index() {
        // $games = Game::All();
        return view('games.games')
                        ->with('title', Lang::trans('title.games'));
    }

    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Game::get();
    //         return Datatables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('action', function($row){
    //                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
    //                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    //                         return $btn;
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //     }
    //     return view('games.games',compact('games'));
    // }

    public function create() {
        $index = 'user|' . Auth::user()->id . '|identifier';

        if (Cache::get($index) == NULL) {
            srand((double) microtime() * 1000000);
            $identifier = rand(10000, 99999);
            Cache::put($index, $identifier, 1800);
        } else {
            $identifier = Cache::get($index);
        }

        return view('games.gamecreate')->with('identifier', $identifier)
                        ->with('title', Lang::trans('title.create_game'));
    }

    public function activate(array $data) {
//        echo "<pre>";
//        print_r('inin');
//        die;
        return Game::update([
                    'status' => $data['1'],
        ]);
    }

    public function activeGame($id) {
//        echo "<pre>";
//        print_r($id);
//        die;
        Game::where('id', $id)->update([
                    'status' => 1,
        ]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function store(Request $request) {
        if (Auth::user()->points >= $request->get('points')) {
            $request->validate([
                'title' => 'required',
                'type' => 'required',
                'points' => 'required',
                // 'city' => 'required',
                'mark_lat' => 'required',
                'mark_long' => 'required',
                // 'district' => 'required',
                'comment' => 'required',
                'full_comment' => 'required',
                // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $index = 'user|' . Auth::user()->id . '|identifier';

            $game = new Game([
                'identifier' => Cache::get($index),
                'title' => $request->get('title'),
                'points' => $request->get('points'),
                'type' => $request->get('type'),
                'city' => 'test',
                // 'district' => $request->get('district'),
                'district' => 'TEST',
                'comment' => $request->get('comment'),
                'full_comment' => $request->get('full_comment'),
                // 'photo' => $request->get('photo'),
                'photo' => 'game.jpg',
                'city_lat' => $request->get('city_lat'),
                'city_long' => $request->get('city_long'),
                'mark_lat' => $request->get('mark_lat'),
                'mark_long' => $request->get('mark_long'),
                'user_id' => Auth::user()->id,
            ]);

            if ($request->has('photo')) {

                $user = Auth::user();
                $photoName = $user->id . '_photo' . time() . '.' . request()->photo->getClientOriginalExtension();
                $game->photo = $request->get('photo');
                $game->photo = $photoName;
                $request->photo->storeAs('game-photos', $photoName);
            }

            $game->save();

            $user = User::where('id', Auth::user()->id)->get()->first();
            $user->points = $user->points - $game->points;
            $user->save();

            Cache::forget($index);

            return redirect('/')->with('success', 'Game has been added!');
        } else {
            return redirect()->back()->with('error', 'You do not have enough points to create game');
        }
    }

    // public function show($id) {
    //     $game = Game::where('id', '=', $id)->with('bids')->firstOrFail();
    //     return view('games.gamedetail')
    //                     ->with('game', $game)
    //                     ->with('title', $game->title);
    // }

    // public function editOLD(User $user, Game $game)
    // {
    //     // If user is administrator, then can edit any post
    //     if ($user->isAdmin()) {
    //         return true;
    //     }
    //     // Check if user is the post author
    //     if ($user->id === $game->user_id) {
    //         return true;
    //     }
    //     return false;
    // }

//     public function edit($id) {
//         $game = Game::where('status', 1)->find($id);
// //        $game = Game::find($id);

//         if (Auth::user()->id == $game->user_id) {
//             return view('games.gameedit', compact('game'))
//                             ->with('title', Lang::trans('title.edit'));
//         }
//         if (Auth::user()->type == 'admin') {
//             return view('games.gameedit', compact('game'))
//                             ->with('title', Lang::trans('title.edit'));
//         } else {
//             return redirect('404');
//         }
//     }

    public function getGameEditModalHtml(Request $request) {
//        $game = Game::where('status', 1)->find($id);
        $game = Game::find($request->id);

        if (Auth::user()->id == $game->user_id) {
            return view('games.gameeditmodal', compact('game'))
                            ->with('title', Lang::trans('title.edit'));
        }
        if (Auth::user()->type == 'admin') {
            return view('games.gameeditmodal', compact('game'))
                            ->with('title', Lang::trans('title.edit'));
        } else {
            return redirect('404');
        }
    }

    public function update(Request $request, $id) {
//        echo "<pre>";
//        print_r($request->all());
//        die;
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'city' => 'required',
            'comment' => 'required',
            'full_comment' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $game = Game::find($id);
        $game->title = $request->get('title');
        $game->type = $request->get('type');
        $game->city = $request->get('city');
        // $game->district = $request->get('district');
        $game->comment = $request->get('comment');
        $game->full_comment = $request->get('full_comment');

        // if ($game->author !== auth()->user()->id || auth()->user()->cannot('edit games')) {
        //     abort(404);
        // }

        if ($request->hasFile('photo')) {
            $user = Auth::user();
            $game->photo = $request->get('photo');
            $photoName = $user->id . '_photo' . time() . '.' . request()->photo->getClientOriginalExtension();
            $game->photo = $photoName;
            $request->photo->storeAs('game-photos', $photoName);
        }

        $game->save();

        return redirect('/games')->with('success', 'Game has been updated');
    }

    // public function destroy($id) {
    //     $game = Game::find($id);

    //     if (Auth::user()->id == $game->user_id) {
    //         $game->delete();
    //     }
    //     if (Auth::user()->type == 'admin') {
    //         $game->delete();
    //     } else {
    //         return redirect('404');
    //     }

    //     return redirect('/games')->with('success', 'Game has been deleted successfully');
    // }

    public function myBids() {
        // $games = Game::All();
        return view('my_bids.my_bids')
                        ->with('title', Lang::trans('title.games'));
    }

    public function getGameModalHtml(Request $request) {
        $game = Game::where('id', '=', $request->id)->with('bids')->firstOrFail();
        $user = User::where('id', '=', $game->user_id)->firstOrFail();

        return view('games.gamedetail_modal', compact('user'))
                        ->with('game', $game)
                        ->with('title', $game->title);
    }

    public function webhook(Request $request) {
        $my_file = 'file.txt';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);

        $my_file = 'file.txt';
        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
        $data = 'This is the data';
        fwrite($handle, json_encode($request->all()));
    }
    public function webhook2() {
//       $my_file = 'file.txt';
//        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
//        $data = 'This is the data';
//        fwrite($handle, $data);

        return 1;
    }

    //    public function getGames()
    //    {
    //        return view('games')
    //             ->with('games',Game::active()->get());
    //    }
    //
    //    public function getGame($id)
    //    {
    //        return view('gamedetail')
    //            ->with('game', Game::where('id','=',$id)->active()->firstOrFail());
    //    }
}

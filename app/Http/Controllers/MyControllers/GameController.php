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
use Illuminate\Support\Facades\DB;

use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use phpseclib\Math\BigInteger;

class GameController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        // $this->middleware('ajax', ['except' => ['index', 'create']]);
    }

    public function index() {
        $games = DB::table('games')
            ->select('id', 'status', 'title', 'country', 'city', 'district', 'type', 'comment', 'points', 'players', 'created_at', 'photo')
            ->whereNotExists(function($query) {
                $query->select(DB::raw(1))->from('game_bids')
                    ->whereRaw('game_bids.game_id = games.id')->where('game_bids.user_id', Auth::user()->id);
            })
            ->where('games.status', '=', '1')
            ->where('games.user_id', '<>', Auth::user()->id)
            ->get();

        return view('games.games')
            ->with('title', 'Games')
            ->with('games', $games);
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
        
        $web3_helper = new \App\Lib\Web3Helper();
        $can = $web3_helper->canCreateGame(Auth::user()->wallet_address);

        if ($can === false) {
            return redirect('/');
        }

        if (Cache::get($index) == NULL) {
            srand((double) microtime() * 1000000);
            $identifier = rand(10000, 99999);
            Cache::put($index, $identifier, 1800);
        } else {
            $identifier = Cache::get($index);
        }

        return view('games.gamecreate')
            ->with('identifier', $identifier)
            ->with('title', 'Create a game');
    }

//     public function activate(array $data) {
// //        echo "<pre>";
// //        print_r('inin');
// //        die;
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
// $city = json_decode($result->address['place_id'], true); 
// $district = json_decode($result->address['place_id'], true); 

//         return Game::update([
//             'status' => $data['1'],
//             'city' => $city,
//             'district' => $district,
//         ]);
//     }

    public function activeGame($id, Request $request) {

// $game = Game::find($request->id);

// $lat = $game->mark_lat;
// $long = $game->mark_long;

// $url = 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&accept-language=en-US&lat='.$lat.'&lon='.$long;
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL,$url);
// curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); 
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// $result= curl_exec ($ch);
// curl_close ($ch);
// $j=json_decode($result, true);
// $city = $j['address']['city']; 
// $suburb = $j['address']['suburb']; 


        Game::where('id', $id)->update([
                    'status' => 1,
                    // 'city' => $city,
                    // 'district' => $suburb,
        ]);

        return redirect()->back()->with('success', 'Status updated successfully!');
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

    public function store(Request $request) {
        $request->validate([
            // 'title' => 'required',
            //'type' => 'required',
            'points' => 'required',
            // 'city' => 'required',
            'mark_lat' => 'required',
            'mark_long' => 'required',
            'players' => 'required',
            'osm_id' => 'required',
            'place_id' => 'required',
            // 'district' => 'required',
            // 'comment' => 'required',
            'full_comment' => 'required',
            // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tx_hash' => ['required', 'string', 'regex:/^0x([A-Fa-f0-9]{64})$/']
        ]);

        if ($this->checkConfirmation($request['tx_hash'], $request['points'])) {
            $index = 'user|' . Auth::user()->id . '|identifier';


            $game = new Game([
                'identifier' => Cache::get($index),
                'title' => 'Title',
                'points' => $request->get('points'),
                'type' => 'Item',
                'city' => $request->get('city'),
                'status' => '1',
                'country' => $request->get('country'),
                'players' => $request->get('players'),
                // 'district' => $request->get('district'),
                'district' => $request->get('district'),
                'osm_id' => $request->get('osm_id'),
                'place_id' => $request->get('place_id'),
                'comment' => 'Comment',
                'full_comment' => $request->get('full_comment'),
                // 'photo' => $request->get('photo'),
                'photo' => 'game.jpg',
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
            return redirect()->back()->with('error', 'Transaction confirmation failed');
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
                            ->with('title', 'Edit');
        }
        if (Auth::user()->type == 'admin') {
            return view('games.gameeditmodal', compact('game'))
                            ->with('title', 'Edit');
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
            'city' => 'required',
            'comment' => 'required',
            'full_comment' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $game = Game::find($id);
        $game->title = $request->get('title');
        $game->type = 'Item';
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
                        ->with('title', 'My Bids');
    }

    public function getGames(Request $request) {
        $game = Game::where('id', '=', $request->id)->with('bids')->firstOrFail();
        $user = User::where('id', '=', $game->user_id)->firstOrFail();

        return view('games.gamedetail_games', compact('user'))
                        ->with('game', $game)
                        ->with('title', $game->title);
    }

    public function getOwnGames(Request $request) {
        $game = Game::where('id', '=', $request->id)->with('bids')->firstOrFail();
        $user = User::where('id', '=', $game->user_id)->firstOrFail();

        return view('games.gamedetail_owngames', compact('user'))
                        ->with('game', $game)
                        ->with('title', $game->title);
    }

    public function getMyBids(Request $request) {
        $game = Game::where('id', '=', $request->id)->with('bids')->firstOrFail();
        $user = User::where('id', '=', $game->user_id)->firstOrFail();

        return view('games.gamedetail_mybids', compact('user'))
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

}

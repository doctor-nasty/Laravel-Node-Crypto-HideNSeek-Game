<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use Illuminate\Support\Facades\Lang;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if($request->has('search')){
            $games = Game::search($request->get('search'))->get();
        }else{
            $games = Game::get();
        }
        return view('pages.search', compact('games'))
        ->with('title', Lang::trans('title.search'));
    }
}
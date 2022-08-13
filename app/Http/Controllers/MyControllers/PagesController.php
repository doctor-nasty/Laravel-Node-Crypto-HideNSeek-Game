<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

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
}

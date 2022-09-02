<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Game;
use App\Models\Promotion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $games = Game::where("user_id", "=", $user->id)->get();
        return view('pages.profile', compact('user', $user, 'games'))
        ->with('title', Lang::trans('title.profile'));
    }

    // public function index($id){
    //     $user = User::findOrFail($id);
    //     return view('pages.user')->with('user', $user);
    // }

    public function users()

    {

        $users = User::all();
        $users = User::orderBy('username')->paginate(10);

        return view('pages.users',compact('users'));

    }



    public function show($id)

    {

        $user = User::find($id);

        return view('pages.usersshow',compact('user'));

    }



    public function usersPost(Request $request)

    {

        request()->validate(['rate' => 'required']);

        $user = User::find($request->id);



        $rating = new \willvincent\Rateable\Rating;

        $rating->rating = $request->rate;

        $rating->user_id = auth()->user()->id;



        $user->ratings()->save($rating);

        if ($rating->save()) {
            $user->average_rating = $user->averageRating;
            $user->save();
        }

        return redirect()->route("users")->with('success', 'შეფასება მიღებულია!');

    }



    public function settings()
    {
        $user = Auth::user();
        $promotion = Promotion::where('user_wallet', $user->wallet_address)->first();

        return view('pages.settings', compact('user'))
                ->with('referral_url', url("/login?referrer={$promotion->referral_id}"))
                ->with('title', 'Settings');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('pages.settings', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'firstname' => ['required', 'string', 'max:255'],
            // 'lastname' => ['required', 'string', 'max:255'],
            // 'username' => ['required', 'string', 'min:3', 'max:15', 'unique:users'],
            // 'gender' => ['required', 'string', 'min:9', 'max:10'],
            // 'date_of_birth' => ['required', 'before:today'],
            // 'phone_number' => ['required', 'string', 'min:9', 'max:9', 'unique:users'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed', 'unique:users'],
            // 'id_number' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
        ]);

        $user = Auth::user();
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->gender = $request->get('gender');
        $user->date_of_birth = $request->get('date_of_birth');
        $user->phone_number = $request->get('phone_number');
        // $user->id_number = $request->get('id_number');

        $user->save();

        return redirect('/settings')->with('success', 'Your settings have been updated');
    }


    public function update_avatar(Request $request)
    {

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarName = $user->id . '_avatar' . time() . '.' . request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('avatars', $avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return back()
            ->with('success', 'You have successfully uploaded an image.');
    }

    public function rate(Request $request)

    {

        request()->validate(['rate' => 'required']);

        $user = User::find($request->id);



        $rating = new \willvincent\Rateable\Rating;

        $rating->rating = $request->rate;

        $rating->user_id = auth()->user()->id;



        $user->ratings()->save($rating);



        return redirect()->route("profile");

    }
}

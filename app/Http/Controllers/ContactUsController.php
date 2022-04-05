<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ContactUS;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUS() {
        return view('pages.contact');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactSaveData(Request $request) {

        $this->validate($request, [
            'username' => 'required',
            'subject' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'user_id' => 'required'
        ]);
        
        ContactUS::create($request->all());

        \Mail::send('emails.contactus', array(
            'username' => $request->get('username'),
            'subject' => $request->get('subject'),
            'email' => $request->get('email'),
            'msg' => $request->get('message')), function($message) use ($request) {
            $user = User::where('id', Auth::user()->id)->get()->first();
            $user->save();
            $message->from('no-reply@unreality.app');
            $message->to('support@unreality.app', 'SUPPORT UNREALITY.APP')->subject($request->get('subject'));
        });

        return back()->with('success', 'Thanks for contacting us!');
    }

}

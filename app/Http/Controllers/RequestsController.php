<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\User;
use App\Requests;
use Illuminate\Support\Facades\Auth;
 
class RequestsController extends Controller
{
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function requests()
   {
       return view('pages.requests');
   }
 
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function requestsSaveData(Request $request)
   {
       $this->validate($request, [
        'username' => 'required',
		'subject' => 'required',
        'email' => 'required|email',
        'message' => 'required',
		'user_id'=> 'required'
        ]);
 
      Requests::create($request->all()); 
   
      \Mail::send('emails.requests',
       array(
           'username' => $request->get('username'),
           'email' => $request->get('email'),
		   'subject' => $request->get('subject'),
           'user_message' => $request->get('message'),
           'user_id' => Auth::user()->id
       ), function($message) use ($request)
   {
    $user = User::where('id', Auth::user()->id)->get()->first();
    $user->save();
    $message->from('no-reply@unreality.app');
    $message->to('support@unreality.app', 'SUPPORT UNREALITY.APP')->subject($request->get('subject'));
 });
 
    return back()->with('success', 'Thanks for contacting us!'); 
   }
}

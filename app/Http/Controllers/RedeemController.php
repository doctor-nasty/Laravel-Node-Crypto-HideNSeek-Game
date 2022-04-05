<?php 
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\User;
use App\Redeem;
use Illuminate\Support\Facades\Auth;
 
class RedeemController extends Controller
{
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function redeem()
   {
       return view('pages.redeem');
   }
 
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function redeemSaveData(Request $request)
   {
       $this->validate($request, [
        'username' => 'required',
        'email' => 'required',
        'points' => 'required|numeric|in:1000,2000,4000,6000,8000,10000',
		'type'=> 'required',
		'wallet'=> 'sometimes',
		'giftcard'=> 'in:Amazon,Ebay,iTunes,Play Store,Apple.com',
		'user_id'=> 'required'
        ]);
 
       Redeem::create($request->all());

       \Mail::send('emails.redeem',
       array(
           'username' => Auth::user()->username,
           'email' => Auth::user()->email,
           'points' => $request->get('points'),
		   'type' => $request->get('type'),
		   'wallet' => $request->get('wallet'),
		   'giftcard' => $request->get('giftcard'),
           'user_id' => Auth::user()->id
       ), function($message) use ($request)
       
   {
      $user = User::where('id', Auth::user()->id)->get()->first();
      $user->points = $user->points - $request->get('points');
      $user->save();
      $message->from('no-reply@unreality.app');
      $message->to('support@unreality.app', 'SUPPORT UNREALITY.APP')->subject($request->get('type'));
   });
        
       return back()->with('success', 'Request have been submited!');
   }
}

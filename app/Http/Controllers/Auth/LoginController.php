<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use Illuminate\Http\Request;
use App\Models\TokenInfo;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function username()
    {
        return 'username';
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock',
        ]);
    }

    public function showLoginForm(Request $request)
    {
        
        $delegations = TokenInfo::where('status', 1)->get();
        $nft_name = [];
        $nft_image = [];

        foreach($delegations as $index => $delegation) {
            // get token metadata
            $url = 'https://bafybeidunbtz7jt2xnhxbm6xfifzzpjokjlf55ztx54u6vgpln6swztwfa.ipfs.nftstorage.link/metadata/'.$delegation->token_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result= curl_exec ($ch);
            curl_close ($ch);
            $j=json_decode($result, true);

            $nft_name[$index] = $j['name'];
            $nft_image[$index] = $j['image'];
        }

        // ->where('owner', '==', '0x5f24f462fb770ccec2f403953352818a0c2d649b');

        $data = Tokeninfo::when($request->has("owner"),function($q)use($request){
            return $q->where("owner","like","%".$request->get("owner")."%");
        })->paginate(5);
        
        foreach($data as $value => $nft) {
            // get token metadata
            $url = 'https://bafybeidunbtz7jt2xnhxbm6xfifzzpjokjlf55ztx54u6vgpln6swztwfa.ipfs.nftstorage.link/metadata/'.$nft->token_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result= curl_exec ($ch);
            curl_close ($ch);
            $j2=json_decode($result, true);

            $nftname[$value] = $j2['name'];
            $nftimage[$value] = $j2['image'];
        }



        if($request->ajax()){
            return view('auth.nft ',['data'=>$data]); 
        } 
        return view('auth.login')
        ->with('data', $data)
        ->with('delegations', $delegations)
        ->with('nftimage', $nftimage)
        ->with('nftname', $nftname)
        ->with('nft_image', $nft_image)
        ->with('nft_name', $nft_name);
        
    }


    public function locked()
    {
    if(!session('lock-expires-at')){
        return redirect('/');
    }

    if(session('lock-expires-at') > now()){
        return redirect('/');
    }

    return view('auth.locked');
    }

    public function unlock(Request $request)
    {
    $check = Hash::check($request->input('password'), $request->user()->password);

    if(!$check){
        return redirect()->route('login.locked')->withErrors([
            'Your password does not match your profile.'
        ]);
    }

    session(['lock-expires-at' => now()->addMinutes($request->user()->getLockoutTime())]);

    return redirect('/');
    }

}

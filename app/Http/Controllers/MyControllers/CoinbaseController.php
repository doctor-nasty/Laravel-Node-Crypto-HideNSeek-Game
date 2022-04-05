<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;
use Illuminate\Support\Facades\Lang;
use Coinbase;
use Auth;

class CoinbaseController extends Controller {

    public function index() {
//        $charges = Coinbase::getCharges();
//        $checkouts = Coinbase::getCheckouts();
//        echo "<pre>";
//        print_r('inin');
//        print_r($charges);
//        print_r($checkouts);
//        die;
//echo "<pre>";
//print_r('inin');
//die;
//        $charge = Coinbase::createCharge([
//                    'name' => 'Test Product',
//                    'description' => 'Description',
//                    'local_price' => [
//                        'amount' => 5,
//                        'currency' => 'USD',
//                    ],
//                    'pricing_type' => 'fixed_price',
//        ]);
//        $charge = Coinbase::getCharge('24a7c97a-8267-4520-955a-0c86ef09b02e');
//
//        echo "<pre>";
//        print_r($charge);
//        die;
$checkouts = Coinbase::getCheckouts();
echo "<pre>";
print_r($checkouts);
die;
        $checkout = Coinbase::createCheckout([
                    'name' => 'Name',
                    'description' => 'Description',
                    'local_price' => [
                        'amount' => 5,
                        'currency' => 'USD',
                    ],
                    'pricing_type' => 'fixed_price',
        ]);
        echo "<pre>";
        print_r('$checkout');
        dd($checkout);
        die;
        $checkoutId = $checkout['data']['id'];
        $checkout = Coinbase::getCheckout($checkoutId);

echo "<pre>";
print_r($checkout);
die;
        $plans = Plan::all();
        return view('coinbase.index', compact('plans'))
                        ->with('title', Lang::trans('title.plans'));
    }

    public function show(Plan $plan, Request $request) {
        if ($request->user()->subscribedToPlan($plan->stripe_plan, 'main')) {
            return redirect()->route('dashboard')->with('success', 'You have already subscribed the plan');
        }
        return view('plans.show', compact('plan'))
                        ->with('title', Lang::trans('title.show_plan'));
    }

    public function buyPoint(Request $request){
//        return 'https://commerce.coinbase.com/charges/8ZKGH3VE';
        $checkout = Coinbase::createCharge([
                    'name' => 'Buy Points',
                    'description' => 'With Crypto Currency',
                    'metadata' => ['user_id' => Auth::user()->id, 'points' => $request->points],
                    'local_price' => [
                        'amount' => ($request->points/30),
//                        'amount' => 0.01,
                        'currency' => 'USD',
                    ],
                    'pricing_type' => 'fixed_price',
        ]);

//        return $checkout['data']['hosted_url'];
        return redirect($checkout['data']['hosted_url']);
    }

}

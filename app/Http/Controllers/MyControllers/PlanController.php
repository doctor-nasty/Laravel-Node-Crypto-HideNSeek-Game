<?php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;
use Illuminate\Support\Facades\Lang;

class PlanController extends Controller
{

	public function index()
	{
	    $plans = Plan::all();
	    return view('plans.index', compact('plans'))
        ->with('title', Lang::trans('title.plans'));
	}

	public function show(Plan $plan, Request $request)
	{
	        if($request->user()->subscribedToPlan($plan->stripe_plan, 'main')) {
	            return redirect()->route('dashboard')->with('success', 'You have already subscribed the plan');
	        }
	        return view('plans.show', compact('plan'))
			->with('title', Lang::trans('title.show_plan'));
 }
}
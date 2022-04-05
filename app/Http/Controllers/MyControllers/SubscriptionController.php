<?php

// SubscriptionController.php

namespace App\Http\Controllers\MyControllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class SubscriptionController extends Controller
{

    public function create(Request $request, Plan $plan)
    {

        if ($request->user()->subscribedToPlan($plan->stripe_plan, 'main')) {
            return redirect()->route('dashboard')->with('success', 'You have already subscribed the plan');
        }

        $plan = Plan::findOrFail($request->get('plan'));

        $request->user()
            ->newSubscription('main', $plan->stripe_plan)
            //	            ->newSubscription('primary', $plan->stripe_plan)
            ->create($request->stripeToken);

        $user = User::where('id', Auth::user()->id)->get()->first();
        $user->points = $user->points + 20;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Your plan subscribed successfully');
    }

    public function cancel()
    {
        $subscription = $this->asStripeSubscription();
    
        $subscription->cancel(['at_period_end' => true]);
    
        // If the user was on trial, we will set the grace period to end when the trial
        // would have ended. Otherwise, we'll retrieve the end of the billing period
        // period and make that the end of the grace period for this current user.
        if ($this->onTrial()) {
            $this->ends_at = $this->trial_ends_at;
        } else {
            $this->ends_at = Carbon::createFromTimestamp(
                $subscription->current_period_end
            );
        }
    
        $this->save();
    
        return $this;
    }
}

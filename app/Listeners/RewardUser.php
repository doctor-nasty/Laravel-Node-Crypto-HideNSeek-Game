<?php

namespace App\Listeners;

use App\Events\UserReferred;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Providers\PointsService;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use App\Notifications\ReferralBonus;
use App\User;

class RewardUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserReferred  $event
     * @return void
     */
    public function handle(UserReferred $event)
    {
        $referral = \App\ReferralLink::find($event->referralId);
        if (!is_null($referral)) {
            \App\ReferralRelationship::create(['referral_link_id' => $referral->id, 'user_id' => $event->user->id]);

            // Example...
            if ($referral->program->name === 'მოიწვიეთ მეგობრები') {
                // User who was sharing link
                (new PointsService($referral->user))->addPoints(15);
                // User who used the link
                (new PointsService($event->user))->addPoints(55);

                $details = [
                    'title' => 'მეგობრის მოწვევა',
                    'data' => '+20 ქულა',
                    'thanks' => 'მადლობა!',
                ];
                // $user = User::where('id', $event->user)->first();
                $referral->user->notify(New \App\Notifications\ReferralBonus($details));


            }

        }
    }
}

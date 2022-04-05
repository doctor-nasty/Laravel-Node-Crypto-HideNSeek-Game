<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ReferralBonus extends Notification implements ShouldQueue
{
    use Queueable;

    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
         return ['mail','database'];
    }

    public function toMail($notifiable)
    {
         return (new MailMessage)
                    ->greeting($this->details['title'])
                    ->line($this->details['data'])
                    ->line($this->details['thanks']);

    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->details['title'],
            'data' => $this->details['data']
        ];
    }
}

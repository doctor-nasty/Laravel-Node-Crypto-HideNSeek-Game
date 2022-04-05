<?php

namespace App\Jobs\CoinbaseWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Shakurov\Coinbase\Models\CoinbaseWebhookCall;
use DB;

class HandleCreatedCharge implements ShouldQueue {

    use InteractsWithQueue,
        Queueable,
        SerializesModels;

    /** @var \Shakurov\Coinbase\Models\CoinbaseWebhookCall */
    public $webhookCall;

    public function __construct(CoinbaseWebhookCall $webhookCall) {
        $this->webhookCall = $webhookCall;
    }

    public function handle() {
        // do your work here
        // you can access the payload of the webhook call with `$this->webhookCall->payload`
        //$this->webhookCall->payload->event->data->metadata;

        if (isset($this->webhookCall->payload->event->data->metadata)) {
            if (isset($this->webhookCall->payload->event->data->metadata->user_id) && isset($this->webhookCall->payload->event->data->metadata->points)) {
                DB::table('coinbase_charge_created')->insert(
                        [
                            'user_id' => $this->webhookCall->payload->event->data->metadata->user_id,
                            'charge_id' => $this->webhookCall->payload->event->data->id,
                            'payload' => json_encode($this->webhookCall->payload),
                        ]
                );
            }
        }
    }

}

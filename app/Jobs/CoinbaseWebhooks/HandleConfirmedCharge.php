<?php

namespace App\Jobs\CoinbaseWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Shakurov\Coinbase\Models\CoinbaseWebhookCall;
use DB;
use App\User;
    
class HandleConfirmedCharge implements ShouldQueue {

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
//        $my_file = 'file2.txt';
//        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
//
//        $my_file = 'file2.txt';
//        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
//        $data = 'This is the data';
//        fwrite($handle, json_encode($this->webhookCall->payload));

        //$this->webhookCall->payload = json_decode($this->webhookCall->payload);

        if (isset($this->webhookCall->payload['event']['data']['metadata'])) {
            if (isset($this->webhookCall->payload['event']['data']['metadata']['user_id']) && isset($this->webhookCall->payload['event']['data']['metadata']['points'])) {

//                DB::table('coinbase_charge_created')->insert(
//                        [
//                            'user_id' => $this->webhookCall->payload->event->data->metadata->user_id,
//                            'charge_id' => $this->webhookCall->payload->event->data->id,
//                            'payload' => json_encode($this->webhookCall->payload),
//                        ]
//                );

//                $users = DB::table('coinbase_charge_created')->where([
//                            ['charge_id', '=', $this->webhookCall->payload->event->data->id],
//                            ['user_id', '=', $this->webhookCall->payload->event->data->metadata->user_id],
//                        ])->get();

                $user = User::where('id', $this->webhookCall->payload['event']['data']['metadata']['user_id'])->get()->first();
                $user->points += (int) $this->webhookCall->payload['event']['data']['metadata']['points'];
                $user->save();
            }
        }
        
        DB::table('coinbase_charge_created')->insert(
                [
                    'user_id' => 25,
                    'charge_id' => $this->webhookCall->payload['event']['data']['id'],
                    'payload' => json_encode($this->webhookCall->payload),
                ]
        );
    }

}

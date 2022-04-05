<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    public $table = 'redeem';

    public $fillable = ['username', 'type', 'email', 'points', 'message', 'user_id', 'wallet', 'giftcard'];
}

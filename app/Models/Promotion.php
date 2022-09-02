<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_wallet', 'referral_id', 'num_pirates', 'num_treasures'
    ];

    protected $casts = [
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'referal_id', 'token_id', 'tx_hash', 'status'
    ];

    protected $casts = [
    ];
}

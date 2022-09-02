<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftAward extends Model
{
    use HasFactory;

    protected $fillable = [
        'address', 'nft_type', 'description', 'status', 'tx_hash'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'token_id', 'owner', 'purchase_time'
    ];
}

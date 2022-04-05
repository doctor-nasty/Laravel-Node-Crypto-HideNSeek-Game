<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUS extends Model
{
    public $table = 'contact_us';

    public $fillable = ['username', 'email', 'subject', 'message', 'user_id'];
    
}

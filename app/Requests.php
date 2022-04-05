<?php

namespace App;
	 
use Illuminate\Database\Eloquent\Model;
 
class Requests extends Model
{
 
public $table = 'requests';
 
public $fillable = ['username','email','subject','message', 'user_id'];
 
}

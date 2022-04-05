<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use App\Traits\LockableTrait;
use willvincent\Rateable\Rateable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Billable, LockableTrait, Rateable;

    // public function rateable()
    // {
    //     $user = User::first();

    //     $rating = new willvincent\Rateable\Rating;
    //     $rating->rating = 5;
    //     $rating->user_id = \Auth::id();

    //     $user->ratings()->save($rating);
    // }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'country', 'gender', 'username', 'phone_number', 'date_of_birth', 'email', 'password', 'stripe_id', 'id_number'
    ];

    protected $rules = [
        'date_of_birth' => 'date_format:Y-M-D|before:today',
        'username' => 'required|unique:users',
        'email' => 'required|unique:users',
        'phone_number' => 'required|unique:users',
        'id_number' => 'required|unique:users',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'user';

    public function isAdmin(){
        return $this->type === self::ADMIN_TYPE;
    }

    public function games()
    {
        return $this->hasMany('App\Game');
    }

    public function game_bids()
    {
        return $this->hasMany('App\Game_bid');
    }

    public function getReferrals()
    {
    return ReferralProgram::all()->map(function ($program) {
        return ReferralLink::getReferral($this, $program);
    });
    }
}

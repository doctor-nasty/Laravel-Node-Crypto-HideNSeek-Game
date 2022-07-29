<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;

class PointsService extends ServiceProvider
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function addPoints($points)
    {
        $this->user->points += $points;
        $this->user->save();
    }
}

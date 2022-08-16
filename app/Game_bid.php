<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Game_bid extends Model
{
    use Notifiable;

    public $table = 'game_bids';
    protected $fillable = ['id', 'game_id', 'user_id', 'is_awarded'];


//    public function searchableAs()
//    {
//        return 'games_index';
//    }
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
//    public function toSearchableArray()
//    {
//        $array = $this->toArray();
//
//        return array('id' => $array['id'],'city' => $array['city'],'name' => $array['name'],'country' => $array['country']);
//    }
}

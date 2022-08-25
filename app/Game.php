<?php

namespace App;


use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    use Rememberable;
    protected static $rememberable = true;
    public $table = 'games';
    protected $fillable = ['id', 'identifier', 'user_id', 'points', 'type', 'title', 'comment', 'full_comment', 'city', 'country', 'players', 'district', 'status', 'photo', 'winner_user_id', 'mark_long', 'mark_lat', 'city_lat', 'city_long', 'osm_id', 'place_id'];
    protected $rules = [
        'mark_lat' => 'required',
        'mark_long' => 'required',
    ];
    // public function scopeActive($query) {
    //     return $query->where('status', '=', 1);
    // }

    public function bids() {
        return $this->hasMany('App\Game_bid');
    }

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


public function users()
{
    return $this->belongsTo('App\User');
}
}

<?php

class Payout extends \Eloquent {

    protected $table = 'payouts';
    protected $guarded = ['*'];
    protected $hidden = ['*'];

    public static $rules = [
    ];

    /**
     * Accessors
     */
    public function getPrizesAttribute()
    {
        $prizes['isk'] = 0;
        $prizes['items'] = [];
        foreach ($this->games as $game) {
            if ($game->prizeType->name == 'isk') {
                $prizes['isk'] += $game->prize;
            }
            else {
                array_push($prizes['items'], $game->prize);
            }
            $prizes['isk'] = round($prizes['isk'], 2);
        }
        return $prizes;
    }

    /**
     * Query Scopes
     */

    public function scopeUnverified($query)
    {
        return $query->whereFulfilled(true)->whereVerified(false);
    }

    /**
     * Relationships
     */
    public function winner()
    {
        return $this->belongsTo('Character', 'winner_id');
    }

    public function fulfiller()
    {
        return $this->belongsTo('Character', 'fulfiller_id');
    }

    public function games()
    {
        return $this->hasMany('Game', 'payout_id')->withTrashed();
    }

}
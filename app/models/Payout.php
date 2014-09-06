<?php

class Payout extends \Eloquent {

    protected $table = 'payouts';
    protected $guarded = ['*'];
    protected $hidden = ['*'];

    public static $rules = [
    ];

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
        return $this->hasMany('Game');
    }

}
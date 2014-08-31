<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Character extends \Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $table = 'characters';
    protected $fillable = array('name', 'password');
    protected $hidden = array('password');

    public static $rules = [
        'name' => 'required|min:4|max:32',
        'password' => 'required|min:4|max:32'
    ];

    /**
     * Relationships
     */
    public function deposits()
    {
        return $this->hasMany('Deposit', 'depositor_id');
    }

//    public function gamesInitiated()
//    {
//        return $this->belongsTo('Game', 'initiator_id');
//    }
//
//    public function gamesWon()
//    {
//        return $this->belongsTo('Game', 'winner_id');
//    }
//
//    public function gamesPlayed()
//    {
//        $this->belongsToMany('Game');
//    }

//    public function payouts()
//    {
//        $this->hasMany('Payout');
//    }

}
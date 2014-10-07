<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Character extends \Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $table = 'characters';
    protected $fillable = array('name', 'password', 'key_id', 'v_code');
    protected $hidden = array('password', 'key_id', 'v_code');

    public static $rules = [
        'name' => 'min:4|max:32',
        'password' => 'min:4|max:32'
    ];

    /**
     * Methods
     */
    public function assignRole($role)
    {
        $this->roles()->attach($role);
    }

    public function revokeRole($role)
    {
        $this->roles()->detach($role);
    }

    public function hasRole($name)
    {
        foreach ($this->roles as $role)
        {
            if ($role->name == $name)
            {
                return true;
            }
        }
        return false;
    }


    /**
     * Relationships
     */
    public function roles()
    {
        return $this->belongsToMany('Role', 'characters_roles');
    }

    public function deposits()
    {
        return $this->hasMany('Deposit', 'depositor_id');
    }

    public function gamesInitiated()
    {
        return $this->belongsTo('Game', 'initiator_id');
    }

    public function gamesWon()
    {
        return $this->belongsTo('Game', 'winner_id');
    }

    public function gamesPlayed()
    {
        return $this->belongsToMany('Game', 'characters_games')->withPivot('seat')->withTimestamps();
    }

    public function payouts()
    {
        $this->hasMany('Payout', 'winner_id');
    }

    public function fulfillments()
    {
        $this->hasMany('Payout', 'fulfiller_id');
    }

}
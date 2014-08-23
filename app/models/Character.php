<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Character extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $table = 'characters';
    protected $fillable = array('id', 'name', 'password');
    protected $hidden = array('id', 'password');
    public static $rules = array();

    public function deposits()
    {
        return $this->hasMany('Deposit', 'depositor_id');
    }

}
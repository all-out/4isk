<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Character extends \Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $table = 'characters';
    protected $fillable = array('name', 'password');
    protected $hidden = array('id', 'password');

    public static $rules = array(
        'name' => 'required|min:4|max:32',
        'password' => 'required|min:4|max:32'
    );

    public function deposits()
    {
        return $this->hasMany('Deposit', 'depositor_id');
    }

}
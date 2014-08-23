<?php

class Deposit extends \Eloquent {

    protected $table = 'deposits';
    protected $guarded = array('*');
    protected $hidden = array('*');

    public function getAmountAttribute($value)
    {
        return number_format($value, 2) . ' isk';
    }

    public function depositor()
    {
        return $this->belongsTo('Character', 'depositor_id', 'id');
    }

}
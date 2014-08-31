<?php

class Deposit extends \Eloquent {

    protected $table = 'deposits';
    protected $guarded = ['*'];
    protected $hidden = ['*'];

    /**
     * Relationships
     */
    public function depositor()
    {
        return $this->belongsTo('Character', 'depositor_id', 'id');
    }

}
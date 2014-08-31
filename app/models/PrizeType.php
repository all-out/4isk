<?php

class PrizeType extends \Eloquent {

    protected $table = 'prize_types';
    protected $guarded = ['*'];
    protected $hidden = ['*'];
    public $timestamps = false;

	public static $rules = [
	];

    /**
     * Relationships
     */
    public function games()
    {
        return $this->hasMany('Game');
    }

}
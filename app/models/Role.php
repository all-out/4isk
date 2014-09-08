<?php

class Role extends \Eloquent {

    protected $table = 'roles';
    protected $fillable = ['name'];
    public $timestamps = false;

	public static $rules = [
	];

    /**
     * Relationships
     */
    public function characters()
    {
        return $this->belongsToMany('Character', 'characters_roles');
    }

}
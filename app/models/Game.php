<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Game extends \Eloquent {

    use SoftDeletingTrait;

    protected $table = 'games';
    protected $guarded = ['*'];
    protected $hidden = ['*'];

    public static $rules = [
	];

    /**
     * Accessors
     */
    public function getPrizeAttribute()
    {
        if ($this->prizeType->name == 'isk') {
            return ($this->buy_in * $this->seats) * 0.9;
        }
        else {
            return $this->prizeType->name;
        }
    }

    /**
     * Relationships
     *
     * TODO: Create Payout models, migrations and seeders
     * TODO: Create many to many relationship representing all players in a game
     */
    public function initiator()
    {
        return $this->belongsTo('Character', 'initiator_id');
    }

    public function winner()
    {
        return $this->belongsTo('Character', 'winner_id');
    }

    public function prizeType()
    {
        return $this->belongsTo('PrizeType', 'prize_type_id');
    }
//
//    public function payout()
//    {
//        $this->belongsTo('Payout');
//    }
//
//    public function players()
//    {
//        $this->belongsToMany('Character');
//    }


}
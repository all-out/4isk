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
//        if ($this->prizeType->name == 'isk') {
            return ($this->buy_in * $this->seats) * 0.9;
//        }
//        else {
//            return $this->prizeType->name;
//        }
    }

    /**
     * Relationships
     *
     * TODO: Create PrizeType and Payout models, migrations and seeders
     */
    public function initiator()
    {
        return $this->belongsTo('Character', 'initiator_id');
    }

    public function winner()
    {
        return $this->belongsTo('Character', 'winner_id');
    }

//    public function prizeType()
//    {
//        $this->hasOne('PrizeType', 'prize_type_id');
//    }
//
//    public function payout()
//    {
//        $this->belongsTo('Payout');
//    }

    public function players()
    {
        $this->belongsToMany('Character');
    }


}
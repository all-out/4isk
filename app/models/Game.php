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
            return number_format(($this->buy_in * $this->seats) * 0.9, 2, '.', ',') . ' isk';
        }
        else {
            return $this->prizeType->name;
        }
    }

    /**
     * Relationships
     */
    public function prizeType()
    {
        return $this->belongsTo('PrizeType', 'prize_type_id');
    }

    public function initiator()
    {
        return $this->belongsTo('Character', 'initiator_id');
    }

    public function winner()
    {
        return $this->belongsTo('Character', 'winner_id');
    }

    public function players()
    {
        return $this->belongsToMany('Character', 'characters_games')->withPivot('seat')->withTimestamps();
    }

    public function payout()
    {
        return $this->belongsTo('Payout');
    }

}
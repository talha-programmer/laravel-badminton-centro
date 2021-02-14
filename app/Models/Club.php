<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $table = "clubs";

    protected $fillable = [
        'name',
        'city',
        'address',
        'membership_fee',
        'coach_name',
    ];

    public function clubOwner()
    {
        return $this->belongsTo(ClubOwner::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'clubs_joined')->withPivot(['contract_start', 'contract_end']);
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class,  'clubs_tournaments');
    }

}

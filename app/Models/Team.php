<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'teams_joined');
    }

    /**
     * teamOne in matches table
     * */
    public function matchOne()
    {
        return $this->hasMany(Match::class, 'team_one');
    }

    /**
     * teamTwo in matches table
     **/
    public function matchTwo()
    {
        return $this->hasMany(Match::class, 'team_two');
    }

    /**
     * Get other opponent in a match from Team model
     * */
    public function otherTeam()
    {
        if($this->matchOne->id == $this->id)
        {
            return $this->matchOne;
        }
        return $this->matchTwo;
    }


    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class,  'teams_tournaments');
    }

    public function matches()
    {

        return $this->matchOne->union($this->matchTwo);
    }


}




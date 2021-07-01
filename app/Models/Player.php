<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Player extends Model
{
    use HasFactory;
    protected $table = 'users_players';
    protected $appends = 'age';

    public function getAgeAttribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->user->date_of_birth)->age;
    }


    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'teams_joined');
    }

    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'clubs_joined')->withPivot(['contract_start', 'contract_end']);
    }

    public function matches()
    {
        return $this->belongsToMany(Match::class, 'player_matches')
            ->withPivot('points', 'has_won');
    }

    public function clubsJoined(): string
    {
        $allClubs = "";
        foreach ($this->clubs as $club){
            $allClubs .= $club->name . ', ';
        }
        $allClubs = Str::beforeLast($allClubs, ',');        // remove the last ','
        return $allClubs;
    }

    public function teamsJoined(): string
    {
        $allTeams = "";
        foreach ($this->teams as $team){
            $allTeams .= $team->name . ', ';
        }
        $allTeams = Str::beforeLast($allTeams, ',');        // remove the last ','
        return $allTeams;
    }

    public function getRank()
    {
        $players = Player::OrderByDesc('ranking')->get();
        $counter = 1;
        foreach ($players as $player)
        {
            if($player->id === $this->id){
                return $counter;
            }
            $counter++;
        }

        return -1;
    }



    /**
     * where the current player is the challenger in match challenge
     * */
    public function challenger()
    {
        return $this->hasMany(MatchChallenge::class, 'challenger_player');
    }


    /**
     * where the current player is challenged by another player
     * */
    public function challenged()
    {
        return $this->hasMany(MatchChallenge::class, 'challenged_player');
    }

    public function allChallenges()
    {
        return $this->challenger->union($this->challenged);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Player extends Model
{
    use HasFactory;
    protected $table = 'users_players';


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
        return $this->belongsToMany(Club::class, 'clubs_joined');
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

}

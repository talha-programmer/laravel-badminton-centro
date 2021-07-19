<?php

namespace App\Models;

use App\Enums\TournamentTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tournament extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'tournament_type',
      'start_date',
      'end_date',
    ];

    public function clubs()
    {
        return $this->belongsToMany(Club::class,  'clubs_tournaments');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class,  'teams_tournaments');
    }

    public function matches()
    {
        return $this->hasMany(Match::class,  'tournament_id');
    }

    public function clubOwner()
    {
        return $this->belongsTo(ClubOwner::class, 'club_owner_id');
    }



    public function clubTeams(Club $club)
    {
        $teams = $this->teams()->with('club')
            ->where('club_id', '=', $club->id)->get();

        $allTeams = "";
        foreach ($teams as $team){
            $allTeams .= $team->name . ', ';
        }
        $allTeams = Str::beforeLast($allTeams, ',');        // remove the last ','
        return $allTeams;
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


    public function clubTeams(Club $club)
    {
        return $this->teams()->with('club')
            ->where('club_id', '=', $club->id)->get();
    }



}

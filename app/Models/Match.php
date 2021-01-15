<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $fillable = [
      'match_time',
      'venue',
      'team_one_points',
      'team_two_points',
      'winner_team',
      'match_type',
    ];


    public function players()
    {
        return $this->belongsToMany(Player::class,  'player_matches');
    }

    public function teamOne()
    {
        return $this->belongsTo(Team::class, 'team_one');
    }

    public function teamTwo()
    {
        return $this->belongsTo(Team::class, 'team_two');
    }

    /**
     * Get players of teamOne that are participating in this match
     * */
    public function teamOnePlayers(): array
    {   $teamOnePlayers = array();
        foreach ($this->players as $player){
            foreach ($player->teams as $team){
                if($team->id == $this->teamOne->id){
                    array_push($teamOnePlayers, $player);
                }
            }
        }
        return $teamOnePlayers;
    }

    /**
     * Get players of teamTwo that are participating in this match
     * */
    public function teamTwoPlayers(): array
    {
        $teamTwoPlayers = array();
        foreach ($this->players as $player){
            foreach ($player->teams as $team){
               if ($team->id == $this->teamTwo->id){
                    array_push($teamTwoPlayers, $player);
               }
            }
        }
        return $teamTwoPlayers;
    }

}

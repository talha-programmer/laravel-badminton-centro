<?php


namespace App\Services;

use App\Models\Club;
use App\Models\Match;
use App\Models\Player;
use App\Models\Team;
use Ramsey\Collection\Collection;

/**
 * Used to calculate the ranking of the players. Also, points of the players
 * are calculated in this class
 */
class RankingServices
{
    private const WinningPoints = 4;
    private const LosingPoints = -2;
    private const TiedPoints = 1;

    public static function calculatePlayerRanking(Player $player)
    {
        $player->total_matches =  $player->matches()->where('winner_team', '!=', null)->count();
        $player->won_matches = $player->matches()->where('has_won', '=', '1')->count();
        $player->lost_matches = $player->matches()->where('has_won', '=', '0')->count();
        $player->tied_matches = $player->matches()->where('has_won', '=', '-1')->count();


        $totalPoints = 0;
        foreach ($player->matches as $match){
            $points = $match->pivot->points;
            if($points == null){
                // Skip in case if the match result is not added yet.j
                continue;
            }
            $totalPoints += $points;
        }

        $player->points = $totalPoints;


        $totalMatches= floatval($player->total_matches);
        $won = floatval($player->won_matches);
        $lost = floatval($player->lost_matches);
        $tied = floatval($player->tied_matches);

        $ranking = (($won* self::WinningPoints) + ($lost * self::LosingPoints) + ($tied * self::TiedPoints)) / $totalMatches;

        $player->ranking = $ranking;
        $player->save();

    }


    public static function calculateRankingOfAllPlayers()
    {
        $players = Player::all();
        foreach ($players as $player) {
            self::calculatePlayerRanking($player);
        }
    }
    
    
    public static function calculateTeamRanking(Team $team)
    {
        $won = 0;
        $lost = 0;
        $tied = 0;

        $matches = $team->matches()->unique();
        $totalMatches = count($matches);

        foreach ($matches as $match) {
            if($match->winner_team == $team->id){
                $won++;
            } else if($match->winner_team == -1){
                $tied++;
            } else if($match->winner_team > 0){
                $lost++;
            }
        }

        $team->total_matches = $totalMatches;
        $team->won_matches = $won;
        $team->lost_matches = $lost;
        $team->tied_matches = $tied;

        $ranking = (($won* self::WinningPoints) + ($lost * self::LosingPoints) + ($tied * self::TiedPoints)) / $totalMatches;

        $team->ranking = $ranking;

        $team->save();

    }

    public static function calculateClubRanking(Club $club)
    {
        $clubMatches = collect();
        foreach ($club->teams as $team) {
            $clubMatches = $clubMatches->union($team->matches());
        }

        $clubMatches = $clubMatches->unique();

        $clubMatchesCount = $clubMatches->where('winner_team', '!=', null)->count();

        $club->total_matches = $clubMatchesCount;
        $totalMatches = Match::where('winner_team', '!=', null)->count();

        $club->ranking = $clubMatchesCount / $totalMatches;

        $club->save();
    }


}
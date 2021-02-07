<?php


namespace App\Services;

use App\Models\Player;

/**
 * Used to calculate the ranking of the players. Also, points of the players
 * are calculated in this class
 */
class PlayerServices
{

    public static function calculateRanking()
    {
        $players = Player::all();
        $rankingArr = array();
        foreach ($players as $player){

            $winningPoints = 400;
            $losingPoints = -200;
            $tiedPoints = 100;

            $totalMatches= floatval($player->total_matches);
            $won = floatval($player->won_matches);
            $lost = floatval($player->lost_matches);
            $tied = floatval($player->tied_matches);

            $ranking = (($won* $winningPoints) + ($lost * $losingPoints) + ($tied * $tiedPoints)) / $totalMatches;

            //$ranking = $ranking;
            array_push($rankingArr, $ranking);


        }
        dd($rankingArr);
    }

    public static function calculateTotalMatches(Player $player)
    {

            $player->total_matches =  $player->matches()->where('winner_team', '!=', null)->count();
            $player->won_matches = $player->matches()->where('has_won', '=', '1')->count();
            $player->lost_matches = $player->matches()->where('has_won', '=', '0')->count();
            $player->tied_matches = $player->matches()->where('has_won', '=', '-1')->count();

            $player->save();

    }

    public static function calculateAllPlayersTotalMatches()
    {
        $players = Player::all();
        foreach ($players as $player) {
            self::calculateTotalMatches($player);
        }
    }

    public static function calculateTotalPoints(Player $player)
    {
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

        $player->save();
    }

    public static function calculateAllPlayersTotalPoints()
    {
        $players = Player::all();
        foreach ($players as $player){
            self::calculateTotalPoints($player);
        }
    }

}
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
<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function store(Request $request, Club $club)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $teamId = $request->team_id;
        if($teamId){
            $team = Team::find($teamId);
            $team->name = $request->name;
            $team->save();
        } else{
            $club->teams()->create($request->only('name'));
        }

        return back()->with('info', 'Team saved successfully!');

    }

    public function destroy(Team $team)
    {
        $team->delete();

        return back()->with('info', 'Team deleted successfully!');
    }


    public function removePlayer(Team $team, Player $player)
    {
        $player->teams()->detach($team->id);
        return back()->with('info', 'Player removed from the selected team!');
    }

    /**
     * Get players from a team id through AJAX
     *
     */
    public function getPlayers(Request $request)
    {
        $teamId = $request->team_id;
        $team = Team::all()->find($teamId);
        $players = $team->players;
        $playersArray = array();
        foreach ($players as $player){
            $playersArray[$player->id] = $player->user->name;
        }
        if(sizeof($playersArray) == 0){
            return back()->with('error', 'No player is added in any team! Please add players in teams before proceeding!');
        }
        return \response()->json($playersArray);
    }

}

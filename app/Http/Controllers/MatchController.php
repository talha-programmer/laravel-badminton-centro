<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Player;
use App\Models\Team;
use Carbon\Carbon;
use Carbon\PHPStan\Macro;
use http\Env\Response;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        $matches = Match::all();

        return view('match.index',[
            'matches' => $matches,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'venue' => 'required|max:255',
            'match_time' => 'required',
            'team_one' => 'required|different:team_two',
            'team_one_players' => 'required|min:1',
            'team_two_players' => 'required|min:1',
        ]);

        $matchId = $request->match_id;
        $match = null;
        if($matchId){
            $match = Match::find($matchId);

            // Remove the relation of old teams and players in case of match edit
            $match->teamOne()->dissociate();
            $match->teamTwo()->dissociate();
            $match->players()->detach();

        } else{
            $match = new Match();
        }

        $allTeams = Team::all();
        $teamOne = $allTeams->find($request->team_one);
        $teamTwo = $allTeams->find($request->team_two);

        $match->teamOne()->associate($teamOne);
        $match->teamTwo()->associate($teamTwo);
        $match->venue = $request->venue;

        $matchTime = Carbon::createFromFormat('d/m/Y H:i A', $request->match_time);
        $match->match_time = $matchTime->format('Y-m-d H:i:s');

        $match->match_type = $request->match_type;

        $match->save();

        $teamOnePlayers = $request->team_one_players;
        $teamTwoPlayers = $request->team_two_players;
        $allPlayers = array_merge($teamOnePlayers, $teamTwoPlayers);
        foreach ($allPlayers as $playerId){
            $player = Player::all()->find($playerId);
            $player->matches()->save($match);
        }


        return back()->with('info', 'Match added successfully!');

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

    public function destroy(Match $match)
    {
        $match->delete();

        return back()->with('info', 'Match deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Player;
use App\Models\Team;
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

    public function addMatch()
    {
        $teams = Team::all();

        return view('match.add_match',[
            'teams' => $teams,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'venue' => 'required|max:255',
            'match_time' => 'required',
            'team_one' => 'required|different:team_two',
            'team_one_player_one' => 'required|min:1',
            'team_two_player_one' => 'required|min:1',
        ]);

        $allTeams = Team::all();
        $teamOne = $allTeams->find($request->team_one);
        $teamTwo = $allTeams->find($request->team_two);

        $match = new Match();
        $match->teamOne()->associate($teamOne);
        $match->teamTwo()->associate($teamTwo);
        $match->venue = $request->venue;
        $match->match_time = date("Y-m-d H:i:s", strtotime($request->match_time));

        $match->save();

        $teamOnePlayerOne = Player::all()->find($request->team_one_player_one);
        $teamTwoPlayerOne = Player::all()->find($request->team_two_player_one);
        $teamOnePlayerOne->matches()->save($match);
        $teamTwoPlayerOne->matches()->save($match);

        if($request->team_one_player_two > 0){
            $teamOnePlayerTwo = Player::all()->find($request->team_one_player_two);
            $teamTwoPlayerTwo = Player::all()->find($request->team_two_player_two);

            if($teamOnePlayerTwo == null || $teamTwoPlayerTwo == null){
                return back()->with('error', 'Please select player two of both teams');
            }

            $teamOnePlayerTwo->matches()->save($match);
            $teamTwoPlayerTwo->matches()->save($match);

        }

        return back()->with('status', 'Match added successfully!');

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
        return \response()->json($playersArray);
    }
}

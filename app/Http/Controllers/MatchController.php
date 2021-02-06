<?php

namespace App\Http\Controllers;

use App\Enums\MatchTypes;
use App\Models\Match;
use App\Models\Player;
use App\Models\PlayerMatch;
use App\Models\Team;
use App\Models\Tournament;
use App\Services\PlayerServices;
use Carbon\Carbon;
use Carbon\PHPStan\Macro;
use http\Env\Response;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'clubowner']);
    }

    public function index()
    {
        $matches = Match::latest()->with(['teamOne', 'teamTwo', 'players'])->paginate(3);

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

        $tournamentId = $request->tournament_id;
        if($tournamentId > 0){
            $tournament = Tournament::find($tournamentId);
            $match->tournament()->associate($tournament);
        }

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
     * Save / Edit the result of a match
     */
    public function addResult(Request $request, Match $match)
    {
        foreach ($match->players as $player){
            $request->validate([
                'points_of_player_' . $player->id => 'required|integer|min:0'
            ]);
        }

        $request->validate([
            'team_one_points' => 'required|integer|min:0',
            'team_two_points' => 'required|integer|min:0'
        ]);


        $matchTied = false;

        $teamOnePoints = $request->team_one_points;
        $teamTwoPoints = $request->team_two_points;

        if($teamOnePoints === $teamTwoPoints){
            $matchTied = true;
            $match->winner_team = -1;           // -1 indicates that no team has won and match tied

        } else if($teamOnePoints > $teamTwoPoints){
            $match->winner_team = $match->teamOne->id;

        } else {
            $match->winner_team = $match->teamTwo->id;
        }

        $match->team_one_points = $teamOnePoints;
        $match->team_two_points = $teamTwoPoints;

        $match->save();

        // Now add scores in 'player_matches' table
        foreach ($match->teamOnePlayers() as $player){
            $playerPoints = $request->get('points_of_player_'. $player->id);

            $playerMatch = PlayerMatch::all()->where('match_id', '=', $match->id)
                ->where('player_id', '=', $player->id)->first();

            $playerMatch->points = $playerPoints;
            if($matchTied){
                $playerMatch->has_won = -1;

            } else if ($teamOnePoints > $teamTwoPoints){
                $playerMatch->has_won = true;

            }  else if ($teamTwoPoints > $teamOnePoints){
                $playerMatch->has_won = false;
            }

            $playerMatch->save();

            // Total Points of the current player
            PlayerServices::calculateTotalPoints($player);
        }

        foreach ($match->teamTwoPlayers() as $player){
            $playerPoints = $request->get('points_of_player_'. $player->id);

            $playerMatch = PlayerMatch::all()->where('match_id', '=', $match->id)
                ->where('player_id', '=', $player->id)->first();

            $playerMatch->points = $playerPoints;
            if($matchTied){
                $playerMatch->has_won = -1;

            } else if ($teamTwoPoints > $teamOnePoints){
                $playerMatch->has_won = true;

            }  else if ($teamOnePoints > $teamTwoPoints){
                $playerMatch->has_won = false;
            }

            $playerMatch->save();
        }

        return back()->with('info', 'Match result added successfully!');
    }


    public function destroy(Match $match)
    {
        $match->delete();

        return back()->with('info', 'Match deleted successfully!');
    }
}

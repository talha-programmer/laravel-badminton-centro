<?php

namespace App\Http\Controllers;

use App\Enums\TournamentTypes;
use App\Models\Club;
use App\Models\Match;
use App\Models\News;
use App\Models\Player;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function clubs()
    {
        $clubs = Club::with(['clubOwner.user'])->orderByDesc('ranking')->get()->toArray();
        $response = ['clubs' => $clubs];
        return response($response, 201);
    }

    public function singleClub(Club $club)
    {
        $club->load(['teams', 'players.user', 'clubOwner.user']);
        $club->rank = $club->getRank();
        $club->owner_name = $club->clubOwner->user->name;

        foreach ($club->players as $player){
            $player->rank = $player->getRank();
            $player->club_joined = $player->clubsJoined();
            $player->team_joined = $player->teamsJoined();
        }

        $response = ['club' => $club];
        return response($response, 201);
    }

    public function players()
    {
        $players = Player::with(['user'])->orderByDesc('ranking')->get();

        foreach ($players as $player){
            $player->club_joined = $player->clubsJoined();
            $player->team_joined = $player->teamsJoined();
        }

        $response = ['players' => $players];
        return response($response, 201);
    }

    public function singlePlayer(Player $player)
    {
        $player->rank = $player->getRank();
        $player->club_joined = $player->clubsJoined();
        $player->team_joined = $player->teamsJoined();
        $response = ['player' => $player];
        return response($response, 201);
    }

    public function matches()
    {
        $matches = Match::with(['teamOne:id,name', 'teamTwo:id,name'])->latest('match_time')->limit(30)->get();
        $updatedMatches = [];

        foreach ($matches as $match){
            $matchTime = Carbon::create($match->match_time);
            $match->match_date = $matchTime->format('jS F Y') ;
            $match->match_time = $matchTime->format('h:i A') ;
            array_push($updatedMatches, $match);

        }

        $response = [
            'matches' => $updatedMatches,
        ];
        return response($response, 201);
    }

    public function singleMatch(Match $match)
    {
        $matchTime = Carbon::create($match->match_time);
        $match->match_date = $matchTime->format('jS F Y') ;
        $match->match_time = $matchTime->format('h:i A') ;

        $match->load(['teamOne:id,name', 'teamTwo:id,name']);

        if($match->team_one_points != null){
            $match->result_added = true;
            $matchResult = '';
            if($match->winner_team == -1){
                $matchResult = 'Match Tied!';
            } else{
                $winningPoints = abs($match->team_one_points - $match->team_two_points);
                if($match->winner_team == $match->teamOne->id){
                    $matchResult = "{$match->teamOne->name} won by $winningPoints Points!";
                } else if($match->winner_team == $match->teamTwo->id){
                    $matchResult = "{$match->teamTwo->name} won by $winningPoints Points!";
                }
            }
            $match->match_result = $matchResult;
        }else{
            $match->result_added = false;
        }

        $match->team_one_players = $match->teamOnePlayers();
        $match->team_two_players = $match->teamTwoPlayers();

        $response = [
            'match' => $match,
        ];

        return response($response, 201);
    }

    public function tournaments()
    {
        $tournaments = Tournament::with('matches')->latest()->get();
        foreach($tournaments as $tournament){
            $tournament->start_date = Carbon::create($tournament->start_date)->format('jS F Y');
            $tournament->end_date = Carbon::create($tournament->end_date)->format('jS F Y');
        }
        $response = [
            'tournaments' => $tournaments,
        ];

        return response($response, 201);
    }

    public function singleTournament(Tournament $tournament)
    {
        $tournament->start_date = Carbon::create($tournament->start_date)->format('jS F Y');
        $tournament->end_date = Carbon::create($tournament->end_date)->format('jS F Y');
        $tournament->tournament_type = TournamentTypes::fromValue($tournament->tournament_type)->description;

        $tournament->load(['clubs', 'matches']);

        foreach ($tournament->clubs as $club){
            $club->teams_participating = $tournament->clubTeamNames($club);
        }

        foreach ($tournament->matches as $match){
            $matchTime = Carbon::create($match->match_time);
            $match->match_date = $matchTime->format('jS F Y') ;
            $match->match_time = $matchTime->format('h:i A') ;
            $match->load(['teamOne:id,name', 'teamTwo:id,name']);
        }

        $response = [
            'tournament' => $tournament,
        ];

        return response($response, 201);
    }

    public function news()
    {
        $news = News::latest()->limit(10)->get();
        $response = [
            'news' => $news,
        ];

        return response($response, 201);
    }

    public function singleNews(News $news)
    {
        $response = [
            'news' => $news,
        ];
        return response($response, 201);
    }
}

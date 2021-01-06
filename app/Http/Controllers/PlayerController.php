<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::all();

        return view('player.index', [
            'players' => $players
        ]);
    }

    public function addPlayer()
    {
        $allTeams = Team::all();
        $club = $team = null;
        if(request()->session()->has('selected_club'))
        {
            $club_id = request()->session()->get('selected_club');
            $club = Club::find($club_id);
        }
        if(request()->session()->has('selected_team'))
        {
            $team_id = request()->session()->get('selected_team');
            $team = Team::find($team_id);
        }
        $players = Player::with('user')->get();



        return view('player.add_player', [
            'selected_club' => $club,
            'selected_team' => $team,
            'players' => $players,
            'all_teams' => $allTeams,
        ]);
    }

    public function store(Request $request)
    {
        $player = Player::find($request->player);
        if(request()->session()->has('selected_team'))
        {
            $team_id = request()->session()->get('selected_team');
            $team = Team::find($team_id);
            $player->teams()->save($team);
            $player->clubs()->save($team->club);
        }
        else if(request()->session()->has('selected_club'))
        {
            $club_id = request()->session()->get('selected_club');
            $club = Club::find($club_id);
            $player->clubs()->save($club);
        }

        return back();
    }
}

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
        $selected_team_id = $request->selected_team;
        $player = Player::all()->find($request->player);


        // Same form is used for joining the team as well as only club
        if($selected_team_id > 0)
        {
            if($player->teams->find($selected_team_id) !=null){
                return back()->with('error', 'This player is already added in this team! Cannot add it again!');
            }

            $team_id = $request->selected_team;
            $team = Team::find($team_id);
            $player->teams()->save($team);
        }

        $club_id = $request->selected_club;

        // Join the club only if not already joined!
        if($player->clubs->find($club_id) == null) {
            $club = Club::find($club_id);
            $player->clubs()->save($club);
        }

        return back()->with('info', 'Player added successfully!');
    }

}

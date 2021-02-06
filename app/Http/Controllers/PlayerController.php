<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $players = Player::latest()->with(['matches' , 'user', 'clubs', 'teams'])->paginate(10);

        return view('player.index', [
            'players' => $players
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

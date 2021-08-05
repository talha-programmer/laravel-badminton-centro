<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Player;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['clubowner'])->except('index');
    }

    public function index()
    {
        $players = Player::orderByDesc('ranking')->with(['matches' , 'user', 'clubs', 'teams'])->paginate(10);
        return view('player.index', [
            'players' => $players
        ]);
    }

    public function addClub(Request $request)
    {
        $playerId = $request->player;
        $club = Club::find($request->selected_club);
        if(isset($playerId) && $playerId >0){
            $club->players()->detach($playerId);        // In case of edit

            $player = Player::find($playerId);
            $contract_start = Carbon::createFromFormat('d/m/Y', $request->contract_start);
            $contract_end = Carbon::createFromFormat('d/m/Y', $request->contract_end);

            $club->players()->attach($player, ['contract_start' => $contract_start, 'contract_end' => $contract_end]);

        }

        return back()->with('info', 'Player successfully added in the club');
    }

    /**
     * Store Player in a team
     */
    public function store(Request $request)
    {
        $selected_team_id = $request->selected_team;
        $player = Player::all()->find($request->player);

        if($selected_team_id > 0)
        {
            if($player->teams->find($selected_team_id) !=null){
                return back()->with('error', 'This player is already added in this team! Cannot add it again!');
            }

            $team_id = $request->selected_team;
            $team = Team::find($team_id);
            $player->teams()->save($team);
        }

        return back()->with('info', 'Player added successfully!');
    }

}

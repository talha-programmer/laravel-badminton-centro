<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function addTeam(Club $club)
    {
        return view('team.add_team', [
            'club' => $club
        ]);
    }

    public function store(Request $request, Club $club)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $club->teams()->create($request->only('name'));
        return back();

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
}

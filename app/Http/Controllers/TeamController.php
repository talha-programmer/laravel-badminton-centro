<?php

namespace App\Http\Controllers;

use App\Models\Club;
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
}

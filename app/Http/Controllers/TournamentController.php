<?php

namespace App\Http\Controllers;

use App\Enums\TournamentTypes;
use App\Enums\UserTypes;
use App\Models\Club;
use App\Models\Team;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'clubowner']);
    }

    public function index()
    {
        $user = auth()->user();
        $userType = $user->user_type;

        // Get only the tournaments of the clubs owned by this club owner
        if($userType === UserTypes::ClubOwner){
            $clubOwner = $user->userable;
            $tournaments = $clubOwner->tournaments()->paginate(2);
        } else {
            $tournaments = Tournament::latest()->with(['matches', 'clubs', 'teams'])->paginate(2);
        }


        return view('tournament.index', [
            'tournaments' => $tournaments,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'tournament_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $tournament = null;
        $tournamentId = $request->tournament_id;
        if($tournamentId > 0){
            $tournament = Tournament::find($tournamentId);
        } else{
            $tournament = new Tournament();
        }

        $tournament->name = $request->name;
        $tournament->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date);
        $tournament->end_date = Carbon::createFromFormat('d/m/Y', $request->end_date);
        $tournament->tournament_type = $request->tournament_type;

        $user = auth()->user();
        $userType = $user->user_type;
        if($userType === UserTypes::ClubOwner){
            $tournament->clubOwner()->associate($user->userable);
        }

        $tournament->save();
        return back()->with('info', 'Tournament saved successfully!');
    }

    public function addClub(Request $request, Tournament $tournament)
    {

        $this->validate($request, [
            'club' => 'required',
            'teams' => 'required',
        ]);

        if($tournament->tournament_type == TournamentTypes::SingleClub){
            if($tournament->clubs()->count() == 1){
                return back()->with('error', 'Cannot add more clubs, One club is already added!');
            }
        }


        $clubId = $request->club;
        $club = Club::find($clubId);

        // Add clubs and teams only if not already present in the database table
        if(!$tournament->clubs->find($club->id)) {
            $tournament->clubs()->save($club);
        }

        foreach ($request->teams as $teamId){
            $team = Team::find($teamId);

            if($tournament->teams->find($team->id) == null) {
                $tournament->teams()->save($team);
            }
        }

        return back()->with('info', 'Club and teams added successfully in the tournament');
    }

    public function removeTeam(Request $request, Tournament $tournament)
    {
        $teamId = $request->team_id;

        $tournament->teams()->detach($teamId);

        return back()->with('info', 'Team removed successfully!');
    }

    public function removeClub(Request $request, Tournament $tournament)
    {
        $clubId = $request->club_id;
        $club = Club::find($clubId);

        foreach ($tournament->clubTeams($club) as $team){
            $tournament->teams()->detach($team->id);
        }

        $tournament->clubs()->detach($clubId);

        return back()->with('info', 'Club removed successfully!');
    }


    public function destroy(Tournament $tournament)
    {
        $tournament->delete();

        return back()->with('info', 'Tournament deleted successfully!');
    }



}

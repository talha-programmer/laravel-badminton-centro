<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Models\Club;
use App\Models\ClubOwner;
use App\Models\Player;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use App\Services\PaginationService;
use http\Env\Response;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function __construct()
    {
        // club middleware is used to determine which type of users are
        // allowed to manage the clubs
        $this->middleware(['auth', 'clubowner'])->except(['getPlayers', 'getTeams']);

        $this->middleware(['director'])->only('store');

    }

    public function index()
    {
        $isDirector = false;
        $user = auth()->user();
        $userType = $user->user_type;


        // Get only the tournaments of the clubs owned by this club owner

        if($userType === UserTypes::ClubOwner){
            $clubOwner = $user->userable;
            $clubs = $clubOwner->clubs()->with(['teams', 'players', 'players.user'])->orderByDesc('ranking')->get();

        } else {
            $isDirector = true;
            $clubs = Club::with(['teams', 'players', 'players.user'])->orderByDesc('ranking')->get();
        }

        // Converting to array to retain the rank as index for pagination
        $clubArray = array();
        $index = 1;
        foreach ($clubs as $club){
            $clubArray[$index] = $club;
            $index++;
        }

        $clubArray = PaginationService::paginate($clubArray, 2);

        return view('club.index', [
            'clubs' => $clubArray,
            'is_director' => $isDirector,
        ]);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'max:255',
        ]);

        $club = null;
        $club_owner = null;

        // Update the existing club if update is called
        if(isset($request->club_id)){
            $club = Club::find($request->club_id);
        } else{
            $club = new Club();
        }

        if (isset($request->club_owner)) {
            $club_owner = ClubOwner::find($request->club_owner);
        } else {
            $club_owner = auth()->user()->userable;
        }

        $club->name = $request->name;
        $club->city = $request->city;
        $club->address = $request->address;
        $club->club_owner_id = $club_owner->id;

        $club->save();

        return back()->with('info', 'Club saved successfully!');
    }

    public function destroy(Club $club)
    {

        $club->delete();

        return back()->with('info', "Club has been deleted successfully!");

    }

    /**
     * Remove player from the selected club. It will delete the
     * related row from pivot table 'clubs_joined'. Also delete the
     * association with all teams of the selected club.
     * */
    public function removePlayer(Club $club, Player $player)
    {
        $player->clubs()->detach($club->id);

        // Removing associations of the player from all teams of the selected club
        foreach ($club->teams as $team){
            $team->players()->detach($player->id);
        }

        return back()->with('info', 'Player removed from the selected club!');
    }

    /**
     * Get teams from a club id through AJAX
     *
     */
    public function getTeams(Request $request)
    {
        $clubId = $request->club_id;
        $club= Club::all()->find($clubId);
        $teams = $club->teams;
        $teamsArray = array();
        foreach ($teams as $team){
            $teamsArray[$team->id] = $team->name;
        }
        if(sizeof($teamsArray) == 0){
            return back()->with('error', 'No teams found for this club!');
        }
        return \response()->json($teamsArray);
    }

    /**
     * Get players from a club id through AJAX
     *
     */
    public function getPlayers(Request $request)
    {
        $clubId = $request->club_id;
        $club = Club::find($clubId);
        $players = $club->players;
        $playersArray = array();
        foreach ($players as $player){
            $playersArray[$player->id] = $player->user->name;
        }
        /*if(sizeof($playersArray) == 0){
            return \response()->json(['error', 'No players found for this club!']);
        }*/
        return \response()->json($playersArray);
    }

}

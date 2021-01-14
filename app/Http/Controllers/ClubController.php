<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Models\Club;
use App\Models\ClubOwner;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function __construct()
    {
        // club middleware is used to determine which type of users are
        // allowed to manage the clubs
        $this->middleware(['auth', 'club']);
    }

    public function index()
    {
        $clubs = Club::with('teams')->get();

        return view('club.index', [
            'clubs' => $clubs,
        ]);

    }

    public function addClub()
    {
        $userType = auth()->user()->user_type;
        $clubOwners = null;

        if ($userType == UserTypes::Admin || $userType == UserTypes::Director) {
            $clubOwners = ClubOwner::all();
        }


        return view('club.add_club', [
            'club_owners' => $clubOwners,
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
}

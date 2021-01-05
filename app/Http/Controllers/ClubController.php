<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Models\Club;
use App\Models\ClubOwner;
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

        return view('club.index',[
            'clubs' => $clubs,
        ]);

    }

    public function addClub()
    {
        $userType = auth()->user()->user_type;
        $clubOwners = null;

        if($userType == UserTypes::Admin || $userType == UserTypes::Director) {
            $clubOwners = ClubOwner::all();
        }


        return view('club.add_club',[
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

        if(isset($request->club_owner)) {
            $club_owner = ClubOwner::find((int)$request->club_owner);
        }
        else{
            $club_owner = auth()->user()->userable;
        }

        $club_owner->club()->create($request->only('name', 'city', 'address' ));

        return back();
    }
}

<?php

namespace App\View\Components;

use App\Enums\TournamentTypes;
use App\Enums\UserTypes;
use App\Models\Club;
use App\Models\Tournament;
use Illuminate\View\Component;

class TournamentClubForm extends Component
{
    public $tournament;
    public $clubs;
    public $no_more_clubs = false;

    /**
     * Create a new component instance.
     *
     * @param Tournament $tournament
     */
    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;

        if($tournament->tournament_type == TournamentTypes::SingleClub){
            if($tournament->clubs()->count() == 1){
                $this->no_more_clubs = true;
            }
        }

        $user = auth()->user();
        $userType = $user->user_type;


        // Get only the clubs of current clubowner
        if($userType === UserTypes::ClubOwner){
            $clubOwner = $user->userable;
            $this->clubs = $clubOwner->clubs;
        }else {
            $this->clubs = Club::all();
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.tournament-club-form');
    }
}

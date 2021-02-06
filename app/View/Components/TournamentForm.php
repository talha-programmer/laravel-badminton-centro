<?php

namespace App\View\Components;

use App\Enums\UserTypes;
use App\Models\Tournament;
use Illuminate\View\Component;

class TournamentForm extends Component
{
    public $tournament;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Tournament $tournament = null)
    {
        $this->tournament = $tournament;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.tournament-form');
    }

    public function isClubOwner(){
        $user = auth()->user();
        $userType = $user->user_type;

        // Get only the clubs of current clubowner
        if($userType === UserTypes::ClubOwner){
            return true;
        }
        return false;
    }
}

<?php

namespace App\View\Components;

use App\Models\Club;
use App\Models\Tournament;
use Illuminate\View\Component;

class TournamentClubForm extends Component
{
    public $tournament;
    public $clubs;

    /**
     * Create a new component instance.
     *
     * @param Tournament $tournament
     */
    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->clubs = Club::all();
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

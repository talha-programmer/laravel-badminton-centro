<?php

namespace App\View\Components;

use App\Models\Match;
use App\Models\Team;
use Illuminate\View\Component;

class MatchForm extends Component
{
    public $match = null;
    public $teams = null;

    // Players that are already playing the match in case of edit match
    public $teamOnePlayers = null;
    public $teamTwoPlayers = null;



    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Match $match = null)
    {
        $this->teams = Team::all();
        $this->match = $match;
        if($match != null){
            $this->teamOnePlayers = $match->teamOnePlayers();
            $this->teamTwoPlayers = $match->teamTwoPlayers();

        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.match-form');
    }
}

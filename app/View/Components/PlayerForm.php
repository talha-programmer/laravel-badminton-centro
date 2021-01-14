<?php

namespace App\View\Components;

use App\Models\Club;
use App\Models\Player;
use App\Models\Team;
use Illuminate\View\Component;

class PlayerForm extends Component
{
    public $team;
    public $club;
    public $players;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Club $club, Team $team = null)
    {
        $this->club = $club;
        $this->team = $team;

        $this->players = Player::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.player-form');
    }
}

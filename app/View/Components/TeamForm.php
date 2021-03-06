<?php

namespace App\View\Components;

use App\Models\Club;
use App\Models\Team;
use Illuminate\View\Component;

class TeamForm extends Component
{
    public $club;
    public $team;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Club $club, Team $team = null)
    {
        $this->club = $club;
        $this->team = $team;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.team-form');
    }
}

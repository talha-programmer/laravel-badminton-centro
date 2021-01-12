<?php

namespace App\View\Components;

use App\Models\Club;
use Illuminate\View\Component;

class TeamForm extends Component
{
    public $club;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Club $club)
    {
        $this->club = $club;
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

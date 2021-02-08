<?php

namespace App\View\Components;

use App\Models\Club;
use Illuminate\View\Component;

class ChallengeForm extends Component
{
    public $clubs = null;
    public $current_player_id = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->clubs = Club::all();

        $this->current_player_id = auth()->user()->userable->id;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.challenge-form');
    }
}

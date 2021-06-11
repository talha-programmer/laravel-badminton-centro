<?php

namespace App\View\Components;

use App\Models\Match;
use Illuminate\View\Component;

class UpcomingMatch extends Component
{
    public $match;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($match)
    {
        $this->match = $match;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.upcoming-match');
    }
}

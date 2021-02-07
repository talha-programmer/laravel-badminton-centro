<?php

namespace App\View\Components;

use App\Enums\UserTypes;
use App\Models\Club;
use App\Models\ClubOwner;
use Illuminate\View\Component;

class ClubForm extends Component
{
    public $club;
    public $clubOwners;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Club $club = null)
    {
        $this->club = $club;

        $userType = auth()->user()->user_type;
        if ($userType == UserTypes::Admin || $userType == UserTypes::Director) {
            $this->clubOwners = ClubOwner::all();

        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.club-form');
    }

    public function isSelected($clubOwnerId){
        return $this->club != null && $this->club->clubOwner->id === $clubOwnerId;
    }

}

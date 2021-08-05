<?php

namespace App\View\Components;

use App\Models\Club;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\View\Component;

class ClubPlayerForm extends Component
{
    public $club = null;
    public $players = null;
    public $player_id = null;
    public $contract_start = null;
    public $contract_end = null;
    /**
     * Create a new component instance.
     *
     * @param Club $club
     */
    public function __construct(Club $club, Player $player = null)
    {
        $this->club = $club;

        if($player->id != null){
            $this->player_id = $player->id;
            $clubPlayer = $this->club->players()->find($player->id);
            $this->players = array($clubPlayer);
            $this->contract_start = Carbon::create($clubPlayer->pivot->contract_start)->format('d/m/Y');
            $this->contract_end = Carbon::create($clubPlayer->pivot->contract_end)->format('d/m/Y');
        }else{
            // Get the players which are not added in any club
            $this->players = Player::doesntHave('clubs')->get();
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.club-player-form');
    }

    public function isPlayer($playerId)
    {
        if($this->player_id == $playerId){
            return 'selected="selected"';
        }else{
            return null;
        }
    }
}

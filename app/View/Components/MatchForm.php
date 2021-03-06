<?php

namespace App\View\Components;

use App\Enums\UserTypes;
use App\Models\Match;
use App\Models\Team;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\View\Component;

class MatchForm extends Component
{
    public $tournament = null;

    public $match = null;
    public $teams = null;

    // Players that are already playing the match in case of edit match
    public $teamOnePlayers = null;
    public $teamTwoPlayers = null;


    /**
     * Create a new component instance.
     *
     * @param Match|null $match
     * @param Tournament|null $tournament
     */
    public function __construct(Match $match = null, Tournament $tournament = null)
    {
        if($tournament->id > 0){
            $this->teams = $tournament->teams;
        } else {
            $user = auth()->user();
            $userType = $user->user_type;

            // Get only the teams of the clubs owned by this club owner

            if($userType === UserTypes::ClubOwner){
                $clubOwner = $user->userable;
                $this->teams = $clubOwner->teams;

            } else {

                $this->teams = Team::all();
            }
        }

        $this->tournament = $tournament;

        $this->match = $match;
        if($match->id > 0){
            $this->teamOnePlayers = array();
            $this->teamTwoPlayers = array();

            foreach ($match->teamOnePlayers() as $player) {
                array_push($this->teamOnePlayers, $player->id);
            }
            foreach ($match->teamTwoPlayers() as $player) {
                array_push($this->teamTwoPlayers, $player->id);
            }

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

    public function matchId()
    {
        $text = "";
        if($this->match->id != null){
            $text .= "_match_" . $this->match->id;
        }
        if($this->tournament->id != null){
            $text .= "_tournament_" . $this->tournament->id;
        }
        return $text;
    }

    public function matchTime()
    {
        if($this->match->id == null){
            return "";
        }
        return Carbon::create($this->match->match_time)->format('d/m/Y h:i A');
    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\ChallengeStatus;
use App\Enums\UserTypes;
use App\Models\Club;
use App\Models\MatchChallenge;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MatchChallengeController extends Controller
{
    public function index()
    {


        $user = auth()->user();
        $userType = $user->user_type;

        $requestsSend = $requestsReceived = null;
        if($userType === UserTypes::Player){
            $player = $user->userable;

            $requestsSend = $player->challenger()->latest()->get();
            $requestsReceived = $player->challenged()->latest()->get();


        } else{
            return back()->with('error', 'You are not allowed to access this page');
        }

        return view('challenge_requests.index', [
            'requests_send' => $requestsSend,
            'requests_received' => $requestsReceived,
        ]);

    }

    public function store(Request $request)
    {
        $currentPlayer = auth()->user()->userable;
        $challengedPlayer = Player::find($request->player);

        $challengeRequest = new MatchChallenge();
        $challengeRequest->challengerPlayer()->associate($currentPlayer);
        $challengeRequest->challengedPlayer()->associate($challengedPlayer);
        $challengeRequest->status = ChallengeStatus::Pending;

        $matchTime = Carbon::createFromFormat('d/m/Y H:i A', $request->match_time);
        $challengeRequest->match_time = $matchTime->format('Y-m-d H:i:s');


        $challengeRequest->save();

        return back()->with('info', 'Challenge request initiated!');

    }

    public function acceptChallenge(Request $request)
    {
        $challengeRequest = MatchChallenge::find($request->challenge_id);
        $challengeRequest->status = ChallengeStatus::Accepted;
        $challengeRequest->save();

        return back()->with('info', 'Match Challenge Accepted!');
    }

    public function rejectChallenge(Request $request)
    {
        $challengeRequest = MatchChallenge::find($request->challenge_id);
        $challengeRequest->status = ChallengeStatus::Rejected;
        $challengeRequest->save();
        return back()->with('info', 'Match Challenge Rejected!');

    }

    public function destroy(Request $request)
    {
        $challengeRequest = MatchChallenge::find($request->challenge_id);
        $challengeRequest->delete();

        return back()->with('info', 'Challenge Request deleted!');
    }
}
